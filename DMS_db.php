<?php
//THIS FILE CONTAINS THE CONNECTION TO THE DATABASE

	//define username, password, and name of database
	$user = 'root';
	$pass = '';
	$db = 'dms';
	//

	//create connection to database
	$dbc = new PDO("mysql:dbname=$db; host=localhost", "$user", "$pass");

	//disable emulated prepared statements and use real prepared statements
	$dbc->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	//catch errors	
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>