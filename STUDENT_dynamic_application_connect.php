<?php
//WHEN A STUDENT SUBMITS THEIR APPLICATION IN STUDENT_dynamic_application IT IS POSTED TO THIS FORM TO BE ENTERED INTO THE DATABASE
//ON THE TABLE FOR THAT SPECIFIC PROGRAM
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";
	

	date_default_timezone_set('America/Chicago');
	//link to file containing database connection string
	require 'DMS_db.php';

	$user_id=$_SESSION['user_id'];

	$application_id= $_POST['application_id'];
	
	//echo $_POST['question_0'];

	$sql="SELECT term, year, number_unique_questions, list_unique_questions, program_id FROM applications WHERE application_id='".$application_id."'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	$x = $stmt->fetch();
	$number_unique_questions = $x['number_unique_questions'];
	$list_unique_questions = $x['list_unique_questions'];
	$term=$x['term'];
	$year=$x['year'];
	$program_id=$x['program_id'];

	$array_unique_questions=explode('(#!BREAK!#)', $list_unique_questions);

	$sql="SELECT name_of_program FROM programs WHERE program_id='".$program_id."'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	$y = $stmt->fetch();
	$name_of_program=$y['name_of_program'];

	//exact copy from DMS_create program_connect.php
	$name_of_table= $application_id."_".str_replace(' ', '_', $name_of_program)."_".$term."_".$year;

	$sql_fields="";
	$sql_values="";
	$sql_array=array();

	//addes each answer to the sql code to be inserted into the database table
	foreach((array) $array_unique_questions as $key=>$value)
	{
		${'question_'.$key}=$_POST['question_'.$key];
		//echo $question;
		if ($sql_fields=="")
		{
			$sql_fields=$sql_fields.'question_'.$key;
			//$sql_values=$sql_values.':question_'.$key;
			$sql_values='?';
			//$sql_array[]="'question_".$key."' =>".${'question_'.$key};
			$sql_array[]=${'question_'.$key};
		}
		else
		{
			$sql_fields=$sql_fields.',question_'.$key;
			//$sql_values=$sql_values.',:question_'.$key;
			$sql_values=$sql_values.',?';
			//$sql_array[]=",'question_".$key."' =>".${'question_'.$key};
			$sql_array[]=${'question_'.$key};
		}
	}

	$sql_fields=$sql_fields.", user_id";
	$sql_values=$sql_values.",?";
	$sql_array[]=$user_id;
	
	
		

	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare("INSERT INTO $name_of_table ($sql_fields)VALUES ($sql_values)");

	$stmt->execute($sql_array);
	
	if (!$stmt)
	{
		echo "error";
	}
	
	$current_date= date('Y-m-d h:i:s a', time());
	
	$stmt = $dbc-> prepare('INSERT INTO review (user_id, application_id, application_submit_time) VALUES (:user_id, :application_id, :application_submit_time)');
	$stmt->execute(array('user_id' => $user_id, 'application_id' => $application_id, 'application_submit_time'=>$current_date));

	header("Location: STUDENT_dashboard.php");
	die();

?>
