<?php

$role_id_array=array("3","1");
require "DMS_authenticate.php";

	require "DMS_general_functions.php";
	//link to file containing database connection string
	require 'DMS_db.php';



  //create variables from those submitted through application form (DMS_Apply.html)
  $supervisor_first_name=$_POST['supervisor_first_name'];
  $supervisor_middle_name=$_POST['supervisor_middle_name'];
  $supervisor_last_name=$_POST['supervisor_last_name'];
  $doctor_EID=$_POST['doctor_EID'];
  $assignment_length=$_POST['assignment_length'];
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  $renew=$_POST['renew'];
  $classification=$_POST['classification'];
  $it_equipment=$_POST['it_equipment'];
  $work_location=$_POST['work_location'];
  $hours_per_week=$_POST['hours_per_week'];
  $hourly_rate=$_POST['hourly_rate'];
  $posting_id = $_POST['posting_id'];


  //prepare SQL statement to prevent SQL injection
  $stmt = $dbc-> prepare('INSERT INTO posting_info (posting_id, supervisor_first_name, supervisor_middle_name, supervisor_last_name, doctor_EID, assignment_length, start_date, end_date, renew, classification, it_equipment, work_location,hours_per_week, hourly_rate) 
  VALUES (:posting_id, :supervisor_first_name, :supervisor_middle_name, :supervisor_last_name, :doctor_EID, :assignment_length, :start_date, :end_date, :renew, :classification,
:it_equipment, :work_location, :hours_per_week, :hourly_rate)');


  //bind variables to prepared statement and execute
  $stmt->execute(array('posting_id' => $posting_id, 'supervisor_first_name' => $supervisor_first_name, 'supervisor_middle_name' => $supervisor_middle_name, 'supervisor_last_name' => $supervisor_last_name,'doctor_EID' => $doctor_EID,'assignment_length' => $assignment_length,'start_date' => $start_date,'end_date' => $end_date,'renew' => $renew,'classification' => $classification,'it_equipment' => $it_equipment,'work_location' => $work_location,'hours_per_week' => $hours_per_week,'hourly_rate' => $hourly_rate ));


  header('Location: DOCTOR_dashboard.php');
  die();


?>
