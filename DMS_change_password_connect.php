<?php
//THIS IS THE FILE THAT WILL EXECUTE THE CHANGE PASSWORD REQUEST 
//ONLY WORKS IF USER KNOWS PASSWORD
//COMES FROM DMS_change_password
require 'DMS_general_functions.php';
$role_id_array=array("1","2","3","4","5");
require "DMS_authenticate.php";

//link to file containing database connection string
require 'DMS_db.php';

try{
	
	if (isset($_POST['id']))
	{
		$id=$_POST['id'];
	}
	else
	{
		$id=$_SESSION['user_id'];
	}
	$password=$_POST['password'];
	$password_2=$_POST['password_2'];
	
	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare('SELECT * FROM user WHERE user_id= :user_id');
	//bind variables to prepared statement and execute
	$stmt->execute(array('user_id' => $id)); 
	
	
	$x = $stmt->fetch();
	
	if(isset($_POST['current_password']))
	{
		$current_password_hash=hash('sha512',$_POST['current_password']);
		if ($current_password_hash != $_SESSION['password_hash'])
		{
			header("Location: DMS_change_password.php?message=0");
			die();
		}
		
		if ($password!=$password_2)
		{
		
			header("Location: DMS_change_password.php?message=1");
			die();
		}
	}
	
	
	if(isset($_POST['id']))
	{
		//if the user already exists, redirect back to the STUDENT_create_profile.php page along with an indication that there was an error
		if (count($x['user_id'])<1)
		{
				
			header("Location: ADMIN_change_user_password.php?message=0");
			die();
		}
	
		if ($password!=$password_2)
		{
		
			header("Location: ADMIN_change_user_password.php?message=1");
			die();
		}
	}
	
	
	
	$password_hash=hash('sha512',$password);

	
	//prepare SQL statement to prevent SQL injection
	$stmt = $dbc-> prepare("UPDATE user SET password = :password WHERE user_id = :id");


	//bind variables to prepared statement and execute
	$stmt->execute(array(':password' => $password_hash, ':id'=>$id));

	
	
	if(isset($_POST['id']))
	{
		header('Location: ADMIN_change_user_password.php?message=2');
		die();
	}
	elseif($_SESSION["role"]=="5")
	{
		header("Location: STUDENT_dashboard.php");
		die();
	}
	elseif($_SESSION["role"]=="4")
	{
		header("Location: DOCTOR_potential_student_table.php?message=6");
		die();
	}
	elseif($_SESSION["role"]=="3")
	{
		header("Location: HR_dashboard.php?message=6");
		die();
	}
	elseif($_SESSION["role"]=="2")
	{
		header("Location: DOCTOR_dashboard.php?message=6");
		die();
	}
	elseif($_SESSION["role"]=="1")
	{
		header("Location: ADMIN_dashboard.php?message=6");
		die();
	}
}

catch(Exception $e)
{
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}




?>