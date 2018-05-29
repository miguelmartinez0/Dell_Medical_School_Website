<?php
//CONTAINS ALL FUNCTIONS THAT ARE REQUIRED FOR THE STUDENT PAGES

$user_id=$_SESSION['user_id'];

//this function gets all the applcations that the specified user has applied to
function get_applications_student_applied_to($user_id)
{
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT application_id FROM review WHERE user_id='". $user_id."'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$reviews= $stmt->fetchAll();
	
	$application_array=array();
	
	foreach ($reviews as $review)
	{
		$sql="SELECT * FROM applications WHERE application_id= ".$review['application_id'];
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		
		$application_array[]=$application;
	}
	
	return $application_array;
}


//returns the application submit time for s specific user and application combination
function get_application_submit_date($user_id, $application_id)
{
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT application_submit_time FROM review WHERE user_id='". $user_id."' AND application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	$date= $review['application_submit_time'];
	
	
	return date('m-d-Y',strtotime($date));
}

//returns the date when the specified student was accepted to the specified program-- in format (Y-m-d)
function get_application_accept_date_not_formatted($user_id, $application_id)
{
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT application_accept_date FROM review WHERE user_id='". $user_id ."' AND application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	$date= $review['application_accept_date'];
	
	
	return date('Y-m-d',strtotime($date));
}


//returns whether or not a student was accepted to the specified program
function get_accepted($user_id, $application_id)
{
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT accepted_by_dms FROM review WHERE user_id='". $user_id ."' AND application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	if ($review['accepted_by_dms'] == '1')
	{
		return "Accepted";
	}
	else
	{
		return "";
	}
}

//returns whether or not a specified student has responded to their offer for the specified application
function get_accepted_offer($user_id, $application_id)
{
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT student_accept_offer FROM review WHERE user_id='". $user_id ."' AND application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	
	if (isset($review['student_accept_offer']))
	{
		return "1";
	}
	else 
	{
		return "0";
	}
}

//returns whether a student has already accepted an offer
function check_student_accepted_offer()

{
	$user_id=$_SESSION['user_id'];
	
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT * FROM review WHERE user_id='". $user_id ."' AND student_accept_offer=1";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	if(!isset($review['user_id']))
	{
		return"FALSE";
	}
	elseif (count($review['user_id'])>0)
	{
		return "TRUE";
	}
	
}

//returns whether or not a specified student has accepted to their offer for the specified application
function get_accepted_declined_offer($user_id, $application_id)
{
	
	require 'DMS_db.php';
	//select all the applications that are active
	$sql="SELECT student_accept_offer FROM review WHERE user_id='". $user_id ."' AND application_id=$application_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
	
	if ($review['student_accept_offer']=="0")
	{
		return "0";
	}
	elseif ($review['student_accept_offer']=="1")
	{
		return "1";
	}
}
























?>
