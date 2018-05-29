<?php
//THIS FILE PULLS TAKES THE DATA SUBMITTED THROUGH STUDENT_create_student_information.php AND ADDS IT TO THE student_info TABLE ON THE DATABASE
//THIS RECORD WILL BE LINKED TO THE USERS PROFILE 
require "DMS_general_functions.php";
$role_id_array=array("5");
require "DMS_authenticate.php";


$user_id=$_SESSION['user_id'];


try{


	//link to file containing database connection string
	require 'DMS_db.php';



	
	//check if the student info already exists in the database
	$stmt = $dbc->query("SELECT * FROM student_info WHERE user_id='".$user_id."'");
	$x = $stmt->fetch();
		
	//if the student info already exists, redirect back to the ADMIN_create_application.php page along with an indication that there was an error
	if (count($x['user_id'])>0)
	{
		header('Location: STUDENT_select_program_apply.php?error=0');
		die();
	}
	
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
	$student_type=$_POST['student_type'];
	$classification=$_POST['classification'];
	$degree_type=$_POST['degree_type'];
	$major=$_POST['major'];
	$major_2=$_POST['major_2'];
	$GPA=$_POST['GPA'];
	$credit_hours = $_POST['credit_hours'];
	$worked_at_dms=$_POST['worked_at_dms'];
	$volunteered_at_seton=$_POST['volunteered_at_seton'];
	$car=$_POST['car'];
	$bilingual = $_POST['bilingual'];
	$semester_commitment=$_POST['semester_commitment'];
	$other_programs = $_POST['other_programs'];

	//turn availability_list into a string 
	$availability= implode(',', $_POST['availability_list']);
	


	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare('INSERT INTO student_info (user_id, first_name, middle_name, last_name, address, city, state, zip_code, phone, email, employment, student_type,
	classification, degree_type, major, major_2, GPA, credit_hours, worked_at_dms, volunteered_at_seton, car, bilingual, semester_commitment, other_programs, availability) VALUES (:user_id, :first_name, :middle_name, :last_name, :address, :city, :state, :zip_code, :phone, 
	:email, :employment, :student_type, :classification, :degree_type, :major, :major_2, :GPA, :credit_hours, :worked_at_dms, :volunteered_at_seton, :car, :bilingual, :semester_commitment, :other_programs, :availability)');


	//bind variables to prepared statement and execute
	$stmt->execute(array('user_id' => $user_id, 'first_name' => $first_name, 'middle_name' => $middle_name, 'last_name' => $last_name,'address' => $address,'city' => $city,
	'state' => $state,'zip_code' => $zip_code,'phone' => $phone,'email' => $email,'employment' => $employment,'student_type' => $student_type,'classification' => $classification,
	'degree_type' => $degree_type,'major' => $major,'major_2' => $major_2, 'GPA'=>$GPA, 'credit_hours' => $credit_hours, 'worked_at_dms' => $worked_at_dms,'volunteered_at_seton' => $volunteered_at_seton,
	'car'=>$car,'bilingual'=>$bilingual, 'semester_commitment' => $semester_commitment, 'other_programs' => $other_programs,'availability' => $availability ));

	

	//direct to page to let student select which program to apply to
	header('Location: STUDENT_select_program_apply.php'); 
	die();
}

catch (Exception $e)
{
	echo "there was an error". $e;
}


?>
