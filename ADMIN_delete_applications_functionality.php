<?php
//THIS FILE CONNECTS TO THE DATABASE USING THE INFORMATION PROVIDED BY THE USER IN ADMIN_view_all_active_applications.php 
//IN ORDER TO DELETE ANY APPLICATIONS AND THEIR CORRESPONDING TABLES

	$role_id_array=array("1");
	require "DMS_authenticate.php";
	//pull the list of applications to be deleted
	$applications= $_POST['application_delete_list'];
	
	
	//loop through the list
	foreach($applications as $value)
	{
		//require db connection string
		require 'DMS_db.php';
	
		//select the record (application) with the given id
		$sql= "SELECT * FROM applications WHERE application_id=$value";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application = $stmt->fetch();
	
		//find the corresponding program and get it's name
		$program_id=$application['program_id'];
		$sql= "SELECT name_of_program FROM programs WHERE program_id=$program_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$program = $stmt->fetch();
		$name_of_program=$program['name_of_program'];
	
		//get the application's other values needed to find table name
		$term=$application['term'];
		$year=$application['year'];
	
		
		//use values to create table name- same process that was used to create the table name on ADMIN_create_application_functionality.php
		$name_of_table= $value."_".str_replace(' ', '_', $name_of_program)."_".$term."_".$year;
	
		//drop the table for this application
		$sql="DROP TABLE $name_of_table";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
	
		//delete this application record from applciations table
		$sql="DELETE FROM applications WHERE application_id=$value";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();

	}
	
	header("Location: ADMIN_view_archived_applications.php");


?>