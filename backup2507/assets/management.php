<?php

try {
	//display errors
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	//includes
	require_once ('firephp/FirePHP.class.php');
	include ('simple_html_dom.php');
	require_once ("configDB.php");
	//Start output buffering
	ob_start();
	$firephp = FirePHP::getInstance(true);
	//$GLOBALS['firephp']->log("File start");
	//global vars
	$writtenSuccesfully = false;
} catch(Exception $ex) {
	echo statusDispatcher("Er is iets fout gegaan tijdens het verwerken van de vertraging", 20);
}

try {
	///*
	$departure = $_POST["departureStation"];
	$arrival = $_POST["arrivalStation"];
	$day = $_POST["lstDay"];
	$month = $_POST["lstMonth"];
	$year = $_POST["lstYear"];
	$hour = $_POST["lstHour"];
	$minutes = $_POST["lstMinutes"];
	/*
	 $departure=$_GET["departureStation"];
	 $arrival=$_GET["arrivalStation"];
	 $day=$_GET["lstDay"];
	 $month=$_GET["lstMonth"];
	 $year= $_GET["lstYear"];
	 $hour=$_GET["lstHour"];
	 $minutes=$_GET["lstMinutes"];*/

	//$GLOBALS['firephp']->log("all variables are valid");
} catch(Exception $ex) {
	//$GLOBALS['firephp']->log("some variables are invalid");

	echo statusDispatcher("Er is iets fout gegaan tijdens het verwerken van de vertraging", 20);

}

try {
	//make sqlconnection
	$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
	mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());

	//$GLOBALS['firephp']->log("connection with DB established");
	//lookup and register registration
	transportLookup($departure, $arrival, $day, $month, $year, $hour, $minutes);
	//close connection with DB
	mysql_close($verbinding);

} catch(Exception $e) {
	echo statusDispatcher("something wrong with MYSQL data", 51);
}

function transportLookup($departure, $arrival, $day, $month, $year, $hour, $minutes) {
	try {

		$currDate = "240712";
		$time = $hour . "" . $minutes;
		//make curl rquest
		$url = "http://api.irail.be/connections/?to=" . $arrival . "&from=" . $departure . "&lang=NL&date=" . $currDate . "&time=" . $time;
		//http://api.irail.be/connections/?to=geel&from=mol&date=120712&time=0903
		//read xml file
		$connections = simplexml_load_file($url, NULL);
		//$GLOBALS['firephp']->log("xml file loaded successfully");

		$day = $_POST["lstDay"];
		$month = $_POST["lstMonth"];
		$year = $_POST["lstYear"];
		$hour = $_POST["lstHour"];
		$minutes = $_POST["lstMinutes"];
		/*
		 $departure=$_GET["departureStation"];
		 $arrival=$_GET["arrivalStation"];
		 $day=$_GET["lstDay"];
		 $month=$_GET["lstMonth"];
		 $year= $_GET["lstYear"];
		 $hour=$_GET["lstHour"];
		 $minutes=$_GET["lstMinutes"];*/

		//$GLOBALS['firephp']->log("all variables are valid");
	} catch(Exception $ex) {
		//$GLOBALS['firephp']->log("some variables are invalid");

		echo statusDispatcher("Er is iets fout gegaan tijdens het verwerken van de vertraging", 20);

	}

	//$GLOBALS['firephp']->log($connections,"xml output");
	//estimate match
	$tryInterval = 30;
	$timeingNegativeInterval = $tryInterval * (-1);
	$timeingPositiveInterval = 0;
	$selectedInterval = $timeingNegativeInterval;
	$maxInterval = 0;

	try {
		//for loop to search to period x in data
		for ($selectedInterval; $selectedInterval <= $maxInterval; $selectedInterval++) {

			if ($selectedInterval == 0) {
				$selectedInterval = $timeingPositiveInterval;
				$maxInterval = 10;
			}
			//$formattedDateTime = formatDate($day,$month,$year) . formatTime($hour,$minutes,$selectedInterval); //does not work
			$formattedDateTime = formatDate("12", "07", $year) . formatTime($hour, $minutes, $selectedInterval);
			$GLOBALS['firephp'] -> log($formattedDateTime, 'formattedDateTime');
			//echo statusDispatcher($formattedDateTime , 100);
			foreach ($connections->connection as $item) {
				//$GLOBALS['firephp']->log("for loop connections started succesfully");

				$query = $item -> departure -> time -> attributes() -> formatted;
				/*$GLOBALS['firephp']->log($formattedDateTime, 'formattedDateTime');
				 $GLOBALS['firephp']->log($query, 'query');*/

				if ($query == $formattedDateTime) {
					//$GLOBALS['firephp']->log($item, 'interval');
					$departureDelay = $item -> departure['delay'];
					$arrivalDelay = $item -> arrival['delay'];
					$totalDelay = $departureDelay + $arrivalDelay;
					//bind to data connection object
					$con = new Connection();
					$con -> departure = (string)$item -> departure -> station;
					$con -> arrival = (string)$item -> arrival -> station;
					$con -> expectedDepartureTime = (string)$item -> departure -> time -> attributes() -> formatted;
					$con -> expectedArrivalTime = (string)$item -> arrival -> time -> attributes() -> formatted;
					$con -> vehicle1 = (string)$item -> arrival -> vehicle;
					//calculate time
					$con -> vehicle2 = (string)$item -> arrival -> vehicle;
					//calculate time
					try {
						//$GLOBALS['firephp']->log("check if via station info is available");
						$con -> vias = (string)$item -> vias -> station;
						//get via station
					} catch(Exception $e) {
						//do nothing
						echo statusDispatcher("Er is iets fout gegaan tijdens het opzoeken van de vertraging", 21);
					}

					$con -> effectiveDepartureTime = formatTime(20, 29, $departureDelay);
					//calculate time
					$con -> effectiveArrivalTime = formatTime(20, 45, $arrivalDelay);
					//calculate time
					$con -> totalDelay = $totalDelay;
					//traces
					$GLOBALS['firephp'] -> log($con -> departure, 'van');
					$GLOBALS['firephp'] -> log($con -> arrival, 'naar');
					$GLOBALS['firephp'] -> log($con -> expectedDepartureTime, 'voorziene vertrek');
					$GLOBALS['firephp'] -> log($con -> expectedArrivalTime, 'voorziene aankomst');
					$GLOBALS['firephp'] -> log($con -> vehicle1, 'trein1');
					$GLOBALS['firephp'] -> log($con -> vehicle2, 'trein2');
					$GLOBALS['firephp'] -> log($con -> effectiveDepartureTime, 'effectieve vertrek');
					$GLOBALS['firephp'] -> log($con -> effectiveArrivalTime, 'effectieve aankomst');
					//write query to DB

					$GLOBALS['writtenSuccesfully'] = true;

					writeEntryToDatabase($con -> departure, $con -> arrival, $con -> expectedDepartureTime, $con -> expectedArrivalTime, $con -> vehicle1, $con -> vehicle2, $con -> effectiveDepartureTime, $con -> effectiveArrivalTime, $con -> totalDelay);

					echo statusDispatcher("De registratie werd succesvol voltooid", 21);
				}
				if ($GLOBALS['writtenSuccesfully'] == true) {
					break;
				}
			}

		}
	} catch(Exception  $ex) {
		//$GLOBALS['firephp']->log($ex , 'error while looking up');
		echo statusDispatcher("Er is iets fout gegaan tijdens het opzoeken van de vertraging", 21);
	}

}

function formatTimeForDataBaseInsertion($input) {
	$positionOfTimeInTimeString = strpos($input, "T");
	$actualPositionOfTime = substr($input, ($positionOfTimeInTimeString + 1), 5);

	return $actualPositionOfTime;
}

function formatVehicleForDataBaseInsertion($vehicle) {
	//cut the 4 last numbers
	$vehicleAccuratePosition = substr($vehicle, (strlen($vehicle) - 4), 4);
	//length  -4
	return $vehicleAccuratePosition;
}

function writeEntryToDatabase($departure, $arrival, $expectedDepartureTime, $expectedArrivalTime, $vehicle1, $vehicle2, $effectiveDepartureTime, $effectiveArrivalTime, $totalDelay) {

	try {
		//save entry in db
		//insert
		$currDate = date('F j, Y');

		//format strings for proper DB
		$departure = strtoupper($departure);
		$arrival = strtoupper($arrival);

		$expectedDepartureTime = formatTimeForDataBaseInsertion($expectedDepartureTime);
		$expectedArrivalTime = formatTimeForDataBaseInsertion($expectedArrivalTime);
		$vehicle1 = formatVehicleForDataBaseInsertion($vehicle1);
		$vehicle2 = formatVehicleForDataBaseInsertion($vehicle2);

		//strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )

		//datum 	van 	naar 	via 	vertrektijd 	aankomsttijd 	trein1 	trein2 	echtevertrektijd 	echteaankomsttijd 	echtetrein1 	echtetrein2 	vertraingen
		$sqlInsert = "INSERT INTO verOverzicht (datum,van,naar,vertrektijd,aankomsttijd,trein1,trein2,echtevertrektijd,echteaankomsttijd,vertraingen) ";
		$sqlInsert .= "VALUES ('$currDate','$departure','$arrival','$expectedDepartureTime','$expectedArrivalTime','$vehicle1','$vehicle2','$effectiveDepartureTime','$effectiveArrivalTime','$totalDelay')";
		//date("F j, Y, g:i a");
		if (mysql_query($sqlInsert)) { statusDispatcher("toegevoegd", 29);
		}

		return true;

	} catch(Exception  $ex) {
		////$GLOBALS['firephp']->log($ex , 'error while adding to db');
		echo statusDispatcher("Fout bij het invoegen in de database", 25);

	}

}

class Connection {

	var $departure;
	var $arrival;
	var $expectedDepartureTime;
	var $expectedArrivalTime;
	var $vehicle1;
	var $vehicle2;
	var $effectiveDepartureTime;
	var $effectiveArrivalTime;
	var $totalDelay;
	var $vias;
	//constructor
	function Connection() {
		//
	}

}

class Status {
	var $errorID;
	var $message;

	//constructor
	function Status() {
		//
	}

}

/*Helper functions*/
function statusDispatcher($value, $id) {
	$GLOBALS['firephp'] -> log($value, "value in statusdispatcher");

	$array = array("errorID" => $id, "message" => $value);
	$array = json_encode($array);
	return ($array);

}

function objectToArray($object) {
	$array = array();
	foreach ($object as $member => $data) {
		$array[$member] = $data;
	}
	return $array;
}

function formatTime($hour, $minutes, $interval) {
	//calculate interval
	$minutesInterval = $minutes + $interval;
	if ($minutesInterval < 0) {
		$minutesInterval = 60 + $minutesInterval;
		$hour--;
	}

	$minutesInterval = leadingZeros($minutesInterval, 2);
	// 01
	$time = $hour . ":" . $minutesInterval . ":00Z";
	//HH:MM:SSZ
	return $time;

}

function formatDate($day, $month, $year) {
	//2012-06-09T
	$date = $year . "-" . $month . "-" . $day . "T";
	return $date;
}

function leadingZeros($num, $numDigits) {
	return sprintf("%0" . $numDigits . "d", $num);
}

function sumAllDelays() {
	//loop to sql
	//count all
	//make calculation
	require_once ("configDB.php");
	$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
	mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());
	$sql = "SELECT `vertraingen` FROM `verOverzicht`";
	$minutes = 0;
	$hours = 0;
	$results = mysql_query($sql);

	while ($row = mysql_fetch_assoc($results)) {

		$vertragingString = $row[0];
		//splitten in uren en minuten
		$pieces = explode(":", $vertragingString);

		$hours += $pieces[0];
		//uren optellen
		$minutes += $pieces[1];
		//uren optellen

		echo "totale vertraging: " . $hours . "uur en" . $minutes . "minuten";
	}

}
?>