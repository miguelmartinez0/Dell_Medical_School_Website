<?php
//THIS FILE CONTAINS FUNCTIONS THAT ARE REGULARLY ACCESSED ACROSS ALL DMS FILES
//ALSO SETS ERROR PAGE

	//set_error_handler("error_redirect");
	function error_redirect($errno, $errstr)
	{
		Header("Location: DMS_error.php");
		echo "<script>window.location = 'DMS_error.php'</script>";
		die();
		
	}
	
	
	
	

	function check_user_exists($id)
	{
		require "DMS_db.php";
		
		$stmt = $dbc->query("SELECT * FROM user WHERE user_id= '$id'");
		$user=$stmt->fetch();
		
		if (count($user['user_id'])<1)
		{
			$value= "NONEXISTENT";
		}
		else
		{
			$value= "EXISTS";
		}
		
		return $value;
	}


	//gets the name of a specific program based on its id
	function get_program($program_id)
	{
		require "DMS_db.php";
		
		$sql="SELECT name_of_program FROM programs WHERE program_id=$program_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$program= $stmt->fetch();
		return $program["name_of_program"];
	}
	

	//gets the information on all programs listed in the "programs" table of the database
	function get_all_programs()
	{
		require "DMS_db.php";
		
		$sql="SELECT program_id, name_of_program FROM programs";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$programs= $stmt->fetchAll();
		
		return $programs;
	}

	
	//pulling a list of all applications from the database
	function get_all_applications()
	{	
		require 'DMS_db.php';
		
		$sql="SELECT * FROM applications";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$applications= $stmt->fetchAll();
		
		return $applications;
	}
	
	//pulling a list of all applications from the database
	function get_all_applications_open()
	{	
		require 'DMS_db.php';
		
		$sql="SELECT * FROM applications WHERE application_closed='0' AND archived='FALSE' ";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$applications= $stmt->fetchAll();
		
		return $applications;
	}
	
	//return a particular application's table name when given only the application_id
	function get_application_table_name($application_id)
	{
		require 'DMS_db.php';
		// get application names
		$sql="SELECT * FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		$name_of_program=get_program($application['program_id']);
		$name_of_table= $application_id."_".str_replace(' ', '_', $name_of_program)."_".$application['term']."_".$application['year'];
		return $name_of_table;
	}
	
	function get_program_from_app_id($application_id)
	{
		require 'DMS_db.php';
		
		$sql="SELECT program_id FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		$program_id=$application['program_id'];
		
		$sql="SELECT name_of_program FROM programs WHERE program_id=$program_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$program= $stmt->fetch();
		return $program['name_of_program'];
	}
	
	//Get the program id given the app id 
	function get_program_id_from_app_id($application_id)
	{
		require 'DMS_db.php';
		
		$sql="SELECT program_id FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		$program_id=$application['program_id'];
		
		return $program_id;
	}
	
	//gets the information on all programs listed in the "programs" table of the database
	function get_all_roles()
	{
		require 'DMS_db.php';
		
		$sql="SELECT * FROM roles";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$roles= $stmt->fetchAll();
		
		return $roles;
	}
	
	//return the application that corresponds to a given id
	function select_application($application_id)
	{
		require 'DMS_db.php';
		// select a specific application using application_id
		$sql="SELECT * FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		return $application;
	}	
	function get_application_position($application_id)
	{
		require 'DMS_db.php';
		// select a specific application using application_id
		$sql="SELECT position_type FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$position= $stmt->fetch();
		return $position;
	}
	function get_application($user_id)
	{
		require 'DMS_db.php';
		
		$sql="SELECT application_id FROM review WHERE user_id = $user_id AND student_accept_offer = 1";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application_id= $stmt->fetch();
		return $application_id;
	}
?>