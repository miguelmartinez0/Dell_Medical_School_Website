<?php

//THIS FILE PULLS TAKES THE DATA SUBMITTED THROUGH STUDENT_create_student_information.php AND ADDS IT TO THE student_info TABLE ON THE DATABASE
//THIS RECORD WILL BE LINKED TO THE USERS PROFILE 
	
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";

	//link to file containing database connection string
	require 'DMS_db.php';

	//get the user id which was passed through the url when student logged in/created a profile
	$user_id=$_SESSION['user_id'];
	
	
	
	
	
	
	/* //check if the student info already exists in the database
	$stmt = $dbc->query("SELECT * FROM student_info WHERE user_id=$user_id");
	$x = $stmt->fetch();
		
	//if the student info already exists, redirect back to the ADMIN_create_application.php page along with an indication that there was an error
	if (count($x['user_id'])>0)
	{
		header('Location: STUDENT_select_program_apply.php?error=0&user_id='.$user_id);
		die();
	} */


	
	//create variables from those submitted through application form (STUDENT_create_student_information.php)
	
	$first_name=$_POST['first_name'];
	$middle_name=$_POST['middle_name'];
	$last_name=$_POST['last_name'];
	
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip_code=$_POST['zip_code'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$employment=$_POST['employment'];
	$classification=$_POST['classification'];
	$student_type=$_POST['student_type'];
	$degree_type=$_POST['degree_type'];
	$major=$_POST['major'];
	$major_2=$_POST['major_2'];
	$GPA=$_POST['GPA'];
	$credit_hours=$_POST['credit_hours'];
	$worked_at_dms=$_POST['worked_at_dms'];
	$volunteered_at_seton=$_POST['volunteered_at_seton'];
	$car=$_POST['car'];
	$bilingual=$_POST['bilingual'];
	$other_programs = $_POST['other_programs'];
	$semester_commitment=$_POST['semester_commitment'];

	//turn availability_list into a string include 'ADMIN_view_application_information.php';
	
	$availability= implode(',', $_POST['availability_list']);
	
	
	

	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare('UPDATE student_info SET first_name=:first_name, middle_name=:middle_name, last_name=:last_name, 
	address=:address, city=:city, state=:state, zip_code=:zip_code, phone=:phone, email=:email, employment=:employment,
	classification=:classification, student_type=:student_type, degree_type=:degree_type, major=:major, major_2=:major_2, GPA=:GPA, credit_hours=:credit_hours, worked_at_dms=:worked_at_dms, 
	volunteered_at_seton=:volunteered_at_seton, car=:car, bilingual=:bilingual, other_programs=:other_programs, semester_commitment=:semester_commitment, availability=:availability 
	WHERE user_id= :user_id');
	
	
	/* UPDATE student_info SET first_name="testingSQL", middle_name="d", last_name="d", EID="EID", 
	address="address", city="city", state="tx", zip_code="43232", phone="324-432-4433", email="email@email.com", employment="UT",
	classification="Grad", degree_type="ba", major="major", major_2="major_2", GPA="3.43", worked_at_dms="0", 
	volunteered_at_seton="1", car="0", semester_commitment="2", availability="M9" 
	WHERE user_id= "11" */
	

	//bind variables to prepared statement and execute
	$stmt->execute(array('first_name' => $first_name, 'middle_name' => $middle_name, 'last_name' => $last_name,'address' => $address,'city' => $city,
	'state' => $state,'zip_code' => $zip_code,'phone' => $phone,'email' => $email,'employment' => $employment,'classification' => $classification, 'student_type'=>$student_type,
	'degree_type' => $degree_type,'major' => $major,'major_2' => $major_2, 'GPA'=>$GPA, 'credit_hours'=>$credit_hours ,'worked_at_dms' => $worked_at_dms,'volunteered_at_seton' => $volunteered_at_seton,
	'car'=>$car, 'bilingual' => $bilingual, 'other_programs' => $other_programs, 'semester_commitment' => $semester_commitment,'availability' => $availability, 'user_id' => $user_id, ));

	
	

	//direct to page to let student select which program to apply to
	header('Location: STUDENT_select_program_apply.php');
	die();


?>
