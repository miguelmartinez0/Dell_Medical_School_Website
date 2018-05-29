<?php
//WHEN USER CREATES A NEW PROFIEL THROUGH STUDENT_create_profile THIS FORM CREATES THAT USER
//ONLY WIL CREATE A USER OF ROLE 5
//ALSO STARTS A NEW SESSION AND DIRECTS THEM TO STUDENT_create_student_information
require "DMS_general_functions.php";

//link to file containing database connection string
require 'DMS_db.php';


try{
	
	$username=strtolower($_POST['username']);
	$password=$_POST['password'];
	$password_2=$_POST['password_2'];
	
	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare('SELECT * FROM user WHERE user_id= :user_id');
	//bind variables to prepared statement and execute
	$stmt->execute(array('user_id' => $username)); 
	
	
	$x = $stmt->fetch();
	
	
	//if this profile is being created by an admin
	if (isset($_POST['role_id']))
	{
			//if the user already exists, redirect back to the ADMIN_create_profile.php page along with an indication that there was an error
		if (count($x['user_id'])>0)
		{
			
			header("Location: ADMIN_create_profile.php?error=2");
			die();
		}
	
		if ($password!=$password_2)
		{
			
			header("Location: ADMIN_create_profile.php?error=1");
			die();
		}
	
	
	
		$password_hash=hash('sha512',$password);

	
		//prepare SQL statement to prevent SQL injection
		$stmt = $dbc-> prepare('INSERT INTO user (user_id, password, role_id) VALUES (:user_id, :password, :role_id)');


		//bind variables to prepared statement and execute
		$stmt->execute(array('user_id' => $username,'password' => $password_hash, 'role_id'=>$_POST['role_id']));

	
		session_start();
		$_SESSION["user_id"] = $username;
		$_SESSION["password_hash"]=$password_hash;
		$_SESSION["role_id"]=$role_id;

		header('Location: ADMIN_dashboard.php?message=2');
		die();
	}
	
	
	
	//if the user already exists, redirect back to the STUDENT_create_profile.php page along with an indication that there was an error
	if (count($x['user_id'])>0)
	{
			
		header("Location: STUDENT_create_profile.php?error=2");
		die();
	}
	
	if ($password!=$password_2)
	{
		
		header("Location: STUDENT_create_profile.php?error=1");
		die();
	}
	
	
	
	$password_hash=hash('sha512',$password);

	
	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare('INSERT INTO user (user_id, password) VALUES (:user_id, :password)');


	//bind variables to prepared statement and execute
	$stmt->execute(array('user_id' => $username,'password' => $password_hash));

	
	session_start();
	$_SESSION["user_id"] = $username;
	$_SESSION["password_hash"]=$password_hash;
	$_SESSION["role"]='5';
	$_SESSION['timeout'] = time();

	header('Location: STUDENT_create_student_information.php');
	die();
}

catch(Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}




?>