<?php
/*Class which handles and generates PIN code verification
 *
 * */
class PinVerificiation {

	//constructor
	function PinVerificiation() {

	}

	/*pin code generator
	 * register new user in db
	 * params: email
	 *
	 * */

	public function registerNewPinVerification($email) {

		$hash = $this -> generatenewPinHash();
		//sql insert
		$sqlInsert = "INSERT INTO verGebruikers (email,pinHash) VALUES ('$email','$hash') ";
		if (mysql_query($sqlInsert)) {

			statusDispatcher("toegevoegd", 29);
		}

		return true;

	}

	/*pin code generator
	 * uses several params to ensure privacy and protection
	 *
	 * */
	public function generatenewPinHash() {
		$pin = null;
		$totalUserAmmount = $this -> getTotalUserCount();
		$currentDate = date("j F Y");
		//generate pincode from two above
		$pin = rand($totalUserAmmount, $currentDate);
		$hash = md5($pin);
		return $hash;
	}

	public function getTotalUserCount() {

		//SQL connect

		$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_PASWOORD) or die("verbinding mislukt:" . mysql_error());
		mysql_select_db(MYSQL_DATABASE) or die("kon database niet openen:" . mysql_error());

		//sql statement
		$sql = "SELECT Sum (*) as `sum` FROM `verGebruikers`";
		//call
		$ammount = mysql_fetch_field("sum");
		//return
		return $ammount;
	}

}
?>