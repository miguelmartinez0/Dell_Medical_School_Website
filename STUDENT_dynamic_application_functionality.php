<?php
//THIS FILE PULLS ALL THE UNIQUE QUESTIONS FOR THE SPECIFIED APPLICATION TO BE DISPLAYED FOR THE STUDENT TO ANSWER 
//DISPLAYS THIS ON STUDENT_DYNAMIC_APPLICATION

	$role_id_array=array("5");
	require "DMS_authenticate.php";
	require 'DMS_db.php';
	

	$user_id=$_SESSION['user_id'];

	$application_id=$_POST['application_id'];

	$sql="SELECT program_id FROM applications WHERE application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$application = $stmt->fetch();

	$sql="SELECT name_of_program FROM programs WHERE program_id=$application[program_id]";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	$program = $stmt->fetch();
	$name_of_program=$program['name_of_program'];

	$sql="SELECT number_unique_questions, list_unique_questions, term, year FROM applications WHERE application_id='".$application_id."'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	$x = $stmt->fetch();

	$term=$x['term'];
	$year=$x['year'];

	$name_of_table= $application_id."_".str_replace(' ', '_', $name_of_program)."_".$term."_".$year;

	$stmt = $dbc->query("SELECT * FROM $name_of_table WHERE user_id='".$user_id."'" );
	$student = $stmt->fetch();

	//if student has already applied to this program, return them to the page to select a program along with error indicating
	//that they have already applied to this program
	if (count($student['user_id'])>0)
	{
		header("Location: STUDENT_select_program_apply.php?error=1");
		die();
	}

	$number_unique_questions = $x['number_unique_questions'];
	$list_unique_questions = $x['list_unique_questions'];

	//echo $number_unique_questions;
	//echo $list_unique_questions;

	$array_unique_questions=explode('(#!BREAK!#)', $list_unique_questions);

?>