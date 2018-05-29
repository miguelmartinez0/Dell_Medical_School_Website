<?php	
//FROM HR_dashboard, THIS EXECUTED COMMAND TO UPDATE FIELDS SPECIFIED BY USER ON A LIST OF STUDENTS
	//require file containing db string
	$role_id_array=array("3","1");
	require "DMS_authenticate.php";
	require 'DMS_db.php';

	
	# Save Changes-button was clicked
	if (isset($_POST['save'])) 
	{	
		//Set all checkboxes to 0 (unchecked)
		$sql = "UPDATE student_info SET bio_data_form = '0', i9 = '0', seton_forms = '0'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
	    if(isset($_POST['background_check_list']))
		{
			$background_check= $_POST['background_check_list'];
		}
		if(isset($_POST['bio_data_form_list']))
		{
			$bio_data_form= $_POST['bio_data_form_list'];
			$bio_data_form_list=implode(',',(array)$bio_data_form);
		}
		if (isset($_POST['i9_list']))
		{
			$i9= $_POST['i9_list'];
			$i9_list=implode(',',(array)$i9);
		}
		if (isset($_POST['seton_forms_list']))
		{
			$seton_forms= $_POST['seton_forms_list'];
			$seton_forms_list=implode(',',(array)$seton_forms);
		}
		
		//$background_check_list=implode(',',$background_check_list);
		
		
		
		
	
		foreach($background_check as $value)
		{
			require 'DMS_db.php';

			$sql="UPDATE student_info SET $value";
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
			//$background = $stmt->fetch();
			
			//$stmt = $dbc-> prepare('UPDATE student_info SET "'.$value.'"');
			//$stmt->execute(array());
	
		}	
		
		if(!empty($_POST['bio_data_form_list']))
		{
			foreach($bio_data_form as $value)
			{
				require 'DMS_db.php';

				$sql="UPDATE student_info SET bio_data_form = 1 WHERE user_id ='". $value."'";
				$stmt=$dbc->prepare($sql);
				$stmt->execute();
				
				
	
			}	
		}
		
		if(!empty($_POST['i9_list']))
		{
			foreach($i9 as $value)
			{
				require 'DMS_db.php';

				$sql="UPDATE student_info SET i9 = 1 WHERE user_id= '".$value."'";
				$stmt=$dbc->prepare($sql);
				$stmt->execute();		
			}
		}
		
		if(!empty($_POST['seton_forms_list']))
		{
			foreach($seton_forms as $value)
			{
				require 'DMS_db.php';

				$sql="UPDATE student_info SET seton_forms = 1 WHERE user_id= '".$value."'";
				$stmt=$dbc->prepare($sql);
				$stmt->execute();		
			}
		}
		
		if (!$stmt)
		{
			die ('SQL Error: ' . mysqli_error($dbc));
		}
		else
		{
			header("Location: HR_dashboard.php");
			die();
		}
	}

?>