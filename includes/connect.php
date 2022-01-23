<?php
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : connect.php
 *? DESCRIPTION : Connection page
 *? CREATED ON  : 24-10-2019
 *********************************************/
// attempt to connect to mariaDB on the Mercury server
try {
	// store user login info into variables
	$user="sanjqgbl_try";
	$passWord="yrBuCvBR5HwFPcs";
	$host="localhost";
	$dbName="sanjqgbl_projects";

	// create an object from the PDO Data Object (pdo) class to establish connection
	$pdo=new PDO("mysql:host=$host;dbname=$dbName", $user, $passWord);

	// default mode is silent failure for establishing connection
	// set our pdo object error mode to throw exceptions
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	// default character coding for database connection is ISO-8859-1
	// change to character coding of UTF-8
	$pdo->exec("SET NAMES 'utf8'");
}

// else when connection failed
catch(PDOException $e) {
	// create an error message with exception details
	echo "Unable to connect to the database server: ".$e->getMessage();

	// stop script from continuing
	exit();
}
?>
