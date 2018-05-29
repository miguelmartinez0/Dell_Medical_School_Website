<?php

//THIS FOR WILL BE LINKED TO ADMIN_view_application_information.php TO CHANGE THE STATUS OF AN APPLICATION TO CLOSED/OPEN
require 'DMS_general_functions.php';
$role_id_array=array("1");
	require "DMS_authenticate.php";
require 'DMS_db.php';

//if the user has indicated that they want to close or open an application
if( isset($_POST['new_close_application']))
{	
	//get whether to open or close and application as well as the value of the application to be closed
	$new_close_application = $_POST['new_close_application'];
	$application_id = $_POST['application_id'];
	
	
	//change the application's application_closed field to the opposite value (closed or open)
	$sql = "UPDATE applications SET application_closed = '".$new_close_application."' WHERE application_id ='".$application_id."'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
		

	//if statement fails, display error
	if (!$stmt) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	//if statement does not fail, redirect back to DMS_view_application and pass the application id through the url
	else{
		header('Location: ADMIN_view_application_information.php?id='.$application_id);
		die();
	}
	
}

//if the user has indicated that they want to archive an application
elseif(isset($_POST['new_archive_application']))
{
	$new_archive_application = $_POST['new_archive_application'];
	$application_id = $_POST['application_id'];
	
	
	//update the application's "archived" field to ture
	$sql = "UPDATE applications SET archived= 'TRUE' WHERE application_id ='".$application_id."'";	
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	
	//if statement fails, display error
	if (!$stmt) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	//if statement does not fail, redirect back to DMS_view_application and pass the application id through the url
	else{
		header('Location: ADMIN_view_application_information.php?id='.$application_id);
		die();
	}
}

//if the user has indicated that they want to unarchive an application
elseif(isset($_POST['unarchive_application']))
{
	$application_id = $_POST['application_id'];
	
	
	//update the application's "archived" field to false
	$sql = "UPDATE applications SET archived= 'FALSE' WHERE application_id ='".$application_id."'";	
	$stmt=$dbc->prepare($sql);
	$stmt->execute();

	
	//if statement fails, display error
	if (!$stmt) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	//if statement does not fail, redirect back to DMS_view_application and pass the application id through the url
	else{
		header('Location: ADMIN_view_application_information.php?id='.$application_id);
		die();
	}
}



?>