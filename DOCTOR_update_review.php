<?php
//COMES FROM THE DOCTOR_view_detailed_student_info
//UPDATES THE review TABLE FOR THE SPECIFIED USER_ID- APPLICATION_ID COMBINATION
//WILL ALSO ACCEPT A STUDENT AND SEND THEM AN ACCEPTANCE EMAIL
require "DMS_general_functions.php";
$role_id_array=array("2","4");
require "DMS_authenticate.php";
$user_id = $_SESSION['user_id'];
require 'DMS_db.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require './Exception.php';
require './PHPMailer.php';


	date_default_timezone_set('America/Chicago');
	
	//THIS FOR WILL BE LINKED TO DOCTOR_view_detailed_student_info.php TO Change accepted_by_dms
	$student_id=$_POST['user_id'];
	$application_id=$_POST['application_id'];
	$current_date=date('Y-m-d');

	
	
if ($_SESSION['role']==2)
{
	//if user clicked submit button named accept to accept a student
	if($_POST['submit']=="Accept")
	{

	
		
		
			
			//update "accepted" field to true
		
			
			$sql = "UPDATE review SET accepted_by_dms = 1 , application_accept_date= '".$current_date."'  WHERE user_id = '".$student_id."' AND application_id= '".$application_id."'";
			//$stmt=$dbc->prepare($sql);
			//$stmt->execute();
			
				$sql2="SELECT * FROM applications WHERE application_id='".$application_id."'";
				$stmt=$dbc->prepare($sql2);

				//The Email Sender information
	    		$from = 'DellMed.Notifications@gmail.com'; //This will need to change
	    		$from_name = 'Dell Medical School';
	   	 		$subject = 'Conditional Offer Expires in 14 days - Dell Medical School';

				//Finds the email of the student the doctor accepted
				$sql2 = "SELECT email, first_name FROM student_info WHERE user_id = '".$student_id."'";
				$query = $dbc->query($sql2);
			
				while ($row=$query->fetch(PDO::FETCH_ASSOC))
				{
					
					$mailArray = array(
						'recipient' => $row['email'],
						'name' => $row['first_name'],
						'subject'=> 'DMS application',
						'mail_body'=>$mail_body);
					
					
					$recipient = $row['email'];
						
				}
				echo $recipient;
				
					//Instantiate Mailer
					$mail = new PHPMailer;
			    	$mail->From = "$from";  // Sender's email address
			    	$mail->FromName = "$from_name"; // senders name 
					$link="<a href='https://dev-undergraduates.dellmed.utexas.edu/DMS_login.php'>Click to view offer</a>";

					//includes HTML
					$mail->Body = "<p>We are pleased to inform you that you have been selected for one of our current program opportunities. To view your offer, please click the link below. You will need to login to the account you applied through. This is your official offer notification and your offer will expire in 14 days. We are very excited to welcome you to the Dell Medical School team!</p><p>'".$link."'</p><p>Sincerely,</p>DMS Team";
					//doesn't incllude HTML
					$mail->AltBody = 'We are pleased to inform you that you have been selected for one of our current program opportunities. To view your offer, please click the link below. You will need to login to the account you applied through. This is your official offer notification and your offer will expire in 14 days. We are very excited to welcome you to the Dell Medical School team! "'.$link.'" Sincerely, DMS Team';
					
			    	$mail->Subject = "$subject";
			    	$mail->AddAddress($recipient);  // Recipient 
				
			
			
			if(!$mail->send())
			 		{
			  			echo 'Email sent to:' . $recipient . '<br/ >';
			      	  	echo "Mailer Error: " . $mail->ErrorInfo;
			   		}
				
		
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
	}
	//if user clicked submit button named update to save the review field
	elseif($_POST['submit']=="Save")
		{
			
			$new_review = $_POST['new_review'];
			$student_id=$_POST['user_id'];
			
			$hours_working_week=$_POST['hours_working_week'];
			$hourly_rate =$_POST['hourly_rate'];

			// if $new_review exists, update database to set student's review to the new value
			if( ($_POST['new_review'])!== null)
				{
					$new_review = $_POST['new_review'];
					$sql = "UPDATE review SET $new_review WHERE user_id='".$student_id."' AND application_id=".$_POST['application_id'];
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
				}
			if( ($_POST['potential'])!== null)
			{
					$new_potential = $_POST['potential'];
					$sql = "UPDATE review SET potential = '".$new_potential."' WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
			}
			elseif( ($_POST['potential'])== null)
			{
					
					$sql = "UPDATE review SET potential=NULL WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
			}
			if( ($_POST['interview'])!== null)
			{
					$new_interview = $_POST['interview'];
					$sql = "UPDATE review SET interview= '".$new_interview."' WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
			}
			elseif( ($_POST['interview'])== null)
			{
					
					$sql = "UPDATE review SET interview=NULL WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
			}
			
			
			//$stmt2 = $dbc-> prepare('UPDATE student_info SET hours_working_week = :hours_working_week, hourly_rate = :hourly_rate
				//WHERE user_id= :student_id');
	
			$stmt2 = $dbc-> prepare('UPDATE student_info SET hours_working_week = :hours_working_week, hourly_rate = :hourly_rate
			WHERE user_id= :student_id');
		
			$stmt2->execute(array('hours_working_week' => $hours_working_week, 'student_id' => $student_id, 'hourly_rate' => $hourly_rate,));
			
			}
}

elseif ($_SESSION['role']==4)
{
	if( ($_POST['approved'])!== null)
			{
					
					$sql = "UPDATE review SET approved=1 WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
					
					
			}
			elseif(($_POST['approved'])== null)
			{
					
					$sql = "UPDATE review SET approved=NULL WHERE user_id= '".$student_id."' AND application_id='".$_POST['application_id']."'";
					$stmt=$dbc->prepare($sql);
					$stmt->execute();
					
			}
			
			
}
			
	
			
	//if the statement fails, display an error
	//if (!$stmt)
	//{
		//die ('SQL Error: ' . mysqli_error($dbc));
	//}
	//if the statement doesn't fail, redirect back to dms_viewapp and pass student_id in the url
	//else
	//{
		header('Location: DOCTOR_view_detailed_student_info.php?id='.$student_id.'&selected_application='.$application_id.'');
		//die();
	//}
	

?>