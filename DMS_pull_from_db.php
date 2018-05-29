<?php
	
	
	require 'DMS_db.php';

	function dynamic_application($user_id,$application_id)
	{
	
		//get the program_id asociated with the given application 
		$sql="SELECT program_id FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application = $stmt->fetch();
		
		//get the actual program based on program_id
		$sql="SELECT name_of_program FROM programs WHERE program_id=$application[program_id]";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();

		$program = $stmt->fetch();
		
		//pull all the information on the given application using application_id
		$sql="SELECT number_unique_questions, list_unique_questions FROM applications WHERE application_id='".$application_id."'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$x = $stmt->fetch();
	
		return $application,$program, $x
	}

?>