<?php


/*Helper functions*/
function formatTime($hour,$minutes,$interval){
	//calculate interval
	$minutesInterval = $minutes + $interval; 
	if($minutesInterval <0){
			$minutesInterval = 60 + $minutesInterval;
			$hour--;
	}
	
	$minutesInterval = leadingZeros($minutesInterval,2);     // 01
	$time = $hour.":".$minutesInterval.":00Z";//HH:MM:SSZ 
	return $time;

}
function formatDate($day,$month,$year){
	//2012-06-09T
	$date = $year."-".$month."-".$day."T";
	return $date;
}
function leadingZeros($num,$numDigits) {
	return sprintf("%0".$numDigits."d",$num);
}	

//display errors
error_reporting(E_ALL);
ini_set('display_errors','On');	
//includes
require_once('firephp/FirePHP.class.php');
include 'simple_html_dom.php';
require_once("configDB.php");
//Start output buffering
ob_start();
$firephp = FirePHP::getInstance(true);

//global vars 
$writtenSuccesfully = false;

//example input: departureStation=Gent+Sint+Pieters&arrivalStation=Hasselt&lstDay=09&lstMonth=06&lstYear=&lstHour=04&lstMinutes=49	
	/*$departure=$_GET["departureStation"];
	$arrival=$_GET["arrivalStation"];
	$day=$_GET["lstDay"];
	$month=$_GET["lstMonth"];
	$year=$_GET["lstYear"];
	$hour=$_GET["lstHour"];
	$minutes=$_GET["lstMinutes"];*/
	
	$departure=$_POST["departureStation"];
	$arrival=$_POST["arrivalStation"];
	$day=$_POST["lstDay"];
	$month=$_POST["lstMonth"];
	$year=$_POST["lstYear"];
	$hour=$_POST["lstHour"];
	$minutes=$_POST["lstMinutes"];


//make sqlconnection	
	$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
				mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());
				
transportLookup($departure,$arrival,$day,$month,$year,$hour,$minutes);
	


function transportLookup($departure,$arrival,$day,$month,$year,$hour,$minutes){

try{

	//make curl rquest
	$url = "http://api.irail.be/connections/?to=".$departure."&from=".$arrival . "&lang=NL" ;
	//read xml file
	$connections = simplexml_load_file($url,NULL);
	//estimate match
	$tryInterval = 10;
	$timeingNegativeInterval = $tryInterval * (-1);
	$timeingPositiveInterval = 0;
	$selectedInterval = $timeingNegativeInterval;
	$maxInterval =0;
	//for loop to search to period x in data
	for ($selectedInterval; $selectedInterval <=$maxInterval; $selectedInterval++){
	if($selectedInterval ==0){$selectedInterval = $timeingPositiveInterval; $maxInterval = 10;}
		$formattedDateTime = formatDate($day,$month,$year) . formatTime($hour,$minutes,$selectedInterval);
		//$GLOBALS['firephp']->log($formattedDateTime, 'look for this:');

		foreach($connections->connection as $item){
			$query = $item->departure->time->attributes()->formatted ;
			//$GLOBALS['firephp']->log($formattedDateTime, 'formattedDateTime');
			//$GLOBALS['firephp']->log($query, 'query');

			if($query == $formattedDateTime){
				//$GLOBALS['firephp']->log($item, 'interval');
				$departureDelay = $item->departure['delay'];
				$arrivalDelay = $item->arrival['delay'];
				$totalDelay = $departureDelay + $arrivalDelay;
				//bind to data connection object
				$con = new Connection();
				$con->departure= (string) $item->departure->station;
				$con->arrival= (string) $item->arrival->station;
				$con->expectedDepartureTime= (string) $item->departure->time->attributes()->formatted;
				$con->expectedArrivalTime= (string) $item->arrival->time->attributes()->formatted;
				$con->vehicle1=(string) $item->arrival->vehicle;//calculate time
				$con->vehicle2= (string) $item->arrival->vehicle;//calculate time
				try{
					$con->vias= (string) $item->vias->station;//get via station
				}catch(Exception $e){
					//do nothing
				}

				$con->effectiveDepartureTime= "";//calculate time
				$con->effectiveArrivalTime="";//calculate time
				$con->totalDelay="";
				//traces
				$GLOBALS['firephp']->log($con->departure, 'van');
				$GLOBALS['firephp']->log($con->arrival, 'naar');
				$GLOBALS['firephp']->log($con->expectedDepartureTime, 'voorziene vertrek');
				$GLOBALS['firephp']->log($con->expectedArrivalTime , 'voorziene aankomst');			
				//write query to DB
				$GLOBALS['writtenSuccesfully'] = writeEntryToDatabase($con->departure,$con->arrival,$con->expectedDepartureTime,$con->expectedArrivalTime,
				$con->vehicle1,$con->vehicle2,$con->effectiveDepartureTime,$con->effectiveArrivalTime);
			}
		}
		if($GLOBALS['writtenSuccesfully'] == true){
			break;
		}
	}
	}catch(Exception  $ex){	
		$GLOBALS['firephp']->log($ex , 'error while looking up');
	}
}

function formatTimeForDataBaseInsertion($input){
$positionOfTimeInTimeString = strpos($input, "T") ;
	$actualPositionOfTime = substr($input, ($positionOfTimeInTimeString+1) , 5 );
	
	return $actualPositionOfTime;
}

function formatVehicleForDataBaseInsertion($vehicle){
//cut the 4 last numbers
//length  -4

	$vehicleAccuratePosition = substr($vehicle, (strlen($vehicle) -4) , 4 );
	
	return $vehicleAccuratePosition;
}

function writeEntryToDatabase($departure,$arrival,$expectedDepartureTime,$expectedArrivalTime,$vehicle1,$vehicle2,$effectiveDepartureTime,$effectiveArrivalTime){
	try{
	//save entry in db
	//insert
	$currDate = date('F j, Y');
	
	//format strings for proper DB 
	$departure = strtoupper($departure);
	$arrival = strtoupper($arrival);
	
	$expectedDepartureTime = formatTimeForDataBaseInsertion($expectedDepartureTime);
	$expectedArrivalTime = formatTimeForDataBaseInsertion($expectedArrivalTime);
	$vehicle1  = formatVehicleForDataBaseInsertion($vehicle1);
	$vehicle2  = formatVehicleForDataBaseInsertion($vehicle2);
	

	//strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
	
	
	$sqlInsert = "INSERT INTO verOverzicht (datum,van,naar,vertrektijd,aankomsttijd,trein1,trein2,echtevertrektijd,echteaankomsttijd) ";
	$sqlInsert .= "VALUES ('$currDate','$departure','$arrival','$expectedDepartureTime','$expectedArrivalTime','$vehicle1','$vehicle2','$effectiveDepartureTime','$effectiveArrivalTime')";
	//date("F j, Y, g:i a");
	if(mysql_query($sqlInsert)){ print "toegevoegd";}
	
	return true;
	
	}catch(Exception  $ex){
		$GLOBALS['firephp']->log($ex , 'error while adding to db');

	}
						
}

class Connection{
	
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
		function Connection(){
	//
	}

}


?>