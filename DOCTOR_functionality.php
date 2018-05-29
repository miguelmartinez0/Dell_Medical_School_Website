<?php
//ALL THE FUNCTIONS FOR THE DMS_doctor PAGE
	
	require 'DMS_db.php';
	
	
	//return all records contained in the given $student_applicants list
	function select_student_from_list($student_applicants)
	{
		require 'DMS_db.php';
		//select students from student_info using their user_id
		$sql = "SELECT * FROM student_info WHERE user_id IN ($student_applicants)";
		$query= $dbc->query($sql);;
		return $query;
	}

	
	//return student in student_info where the user_id matches the given user_id
	function select_student($user_id)
	{
		require 'DMS_db.php';
		$stmt = $dbc->query("SELECT * FROM student_info WHERE user_id= '".$user_id."'");
		$student = $stmt->fetch();
		return	$student;
	}
	
	//return student in student_info where the user_id matches the given user_id - for code with While loops
	function select_student2($user_id)
	{
		require 'DMS_db.php';
		$result = "SELECT * FROM student_info WHERE user_id ='".$user_id."'";
		$student = $dbc->query($result);
		return $student;
	}

	
	//return all applications that are not archived
	function select_all_applications()
	{
		require 'DMS_db.php';
		//select all the applications that are active
		$sql="SELECT * FROM applications WHERE archived='FALSE'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$applications= $stmt->fetchAll();
		return $applications;
	}
	
	//return all applications that are not archived that are assigned to this doctor
	function select_all_doctor_applications()
	{
		require 'DMS_db.php';
		//select all the applications that are active
		//$sql="SELECT * FROM applications WHERE archived='FALSE' AND user_permissions_eid_list LIKE '%".$_SESSION['user_id']."%'";
		$sql="SELECT * FROM applications WHERE archived='FALSE'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$applications= $stmt->fetchAll();
		
		$doctor_applications=array();
		foreach ($applications as $application)
		{
			$doctor_id_array=explode(',', $application['user_permissions_eid_list']);
			
			if (in_array($_SESSION['user_id'], $doctor_id_array)) 
			{
				$doctor_applications[]=$application;
				
			}
			
		}
		return $doctor_applications;
	}	
	
	
	function select_application2($application_id)
	{
		require 'DMS_db.php';
		// select a specific application using application_id
		$result = "SELECT * FROM applications WHERE application_id = '$application_id'";
		$query= $dbc->query($result);

		if (!$query)
		{
			die ('SQL Error: ' . mysqli_error($dbc));
		}
		
		return $query;
	}

	
	//return the name of a program from its program_id
	function get_program_name($program_id)
	{
		require 'DMS_db.php';
					
			$sql="SELECT name_of_program FROM programs WHERE program_id=$program_id";
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
			$program = $stmt->fetch();
			$name_of_program=$program['name_of_program'];

			return $name_of_program;
	}
	
	//return an array of the id's of all student applicants
	function get_id_array($name_of_table)
	{
		require 'DMS_db.php';
		// get application id
		$sql="SELECT * FROM $name_of_table";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$student_applicants= $stmt->fetchAll();
		$student_applicant_id_array=array();
		foreach($student_applicants as $key=>$value)
		{
			$student_applicant_id_array[]="'".$value["user_id"]."'";
			//echo $value['user_id'];
		}
		$student_applicant_id_list=implode(',',$student_applicant_id_array);
		return $student_applicant_id_list;
	}
	
	//return an array of all students who have applied to the given application
	function select_application_student_list($application_id)
	{
		require 'DMS_db.php';
		
		// select different student info
		$sql="SELECT * FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		

		$name_of_program=get_program($application['program_id']);
		

		$term=$application['term'];
		$year=$application['year'];

		$name_of_table= $application_id."_".str_replace(' ', '_', $name_of_program)."_".$term."_".$year;
		
		

		$sql="SELECT * FROM $name_of_table";
		
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$student_applicants= $stmt->fetchAll();

		$student_applicant_id_array=array();
		
		
		foreach($student_applicants as $key=>$value)
		{
			
			$sql="SELECT * FROM review WHERE user_id='".$value['user_id']."' AND application_id =".$application_id;
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
			$review= $stmt->fetch();
			
			
			$sql="SELECT * FROM review WHERE user_id='".$value['user_id']."' AND application_id !='.$application_id.' AND student_accept_offer=1";
			$stmt=$dbc->prepare($sql);
			$stmt->execute();
			$review2= $stmt->fetch();
			
			if ($review['accepted_by_dms']=='1')
			{
				$student_applicant_id_array[]="'".$value["user_id"]."'";
			}
			elseif (count($review2['user_id']) ==0)
			{
				$student_applicant_id_array[]="'".$value["user_id"]."'";
			}
			
			
			//echo $value['user_id'];
		}
		return $student_applicant_id_array;
	}
	
	//return an array of all students who have applied to the given application
	function select_potential_student_list($application_id)
	{
		require 'DMS_db.php';
		
		// select different student info
		$sql="SELECT * FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();

		$name_of_program=get_program($application['program_id']);

		$term=$application['term'];
		$year=$application['year'];
		
		$sql="SELECT * FROM review WHERE application_id=$application_id AND potential='1'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$potential_students= $stmt->fetchAll();
		$potential_student_array=array();
		 foreach ($potential_students as $key=>$value)
		 {
			 $potential_student_array[]="'".$value["user_id"]."'";
		 }
		 
		$potential_student_list=implode(',',$potential_student_array);
		$name_of_table= $application_id."_".str_replace(' ', '_', $name_of_program)."_".$term."_".$year;
		
		
		try
		{
		$sql="SELECT * FROM $name_of_table WHERE user_id IN ($potential_student_list)";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$student_applicants= $stmt->fetchAll();
		}
		
		catch (Exception $e)
		{
			echo "There are no potential students at this time";
			die();
		}

		$student_applicant_id_array=array();
		foreach($student_applicants as $key=>$value)
		{
			$student_applicant_id_array[]="'".$value["user_id"]."'";
			//echo $value['user_id'];
		}
		return $student_applicant_id_array;
	}

	//return query based on the filter the user specified IF GPA NOT INCLUDED
	function filter($filter_criteria, $and_or, $selected_application_id)
	{
		require 'DMS_db.php';
		// filtering applicants using selected criteria
		$filter_criteria_sql=implode($and_or,$filter_criteria);
		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);
		//$sql="SELECT * FROM student_info WHERE ($filter_criteria_sql) AND user_id IN ($applicant_id_array)";
		$sql="SELECT * FROM student_info INNER JOIN review ON student_info.user_id=review.user_id AND review.application_id=$selected_application_id WHERE ($filter_criteria_sql) AND student_info.user_id IN ($applicant_id_array)";
		$query= $dbc->query($sql);;
		//echo "Displaying students where $filter_criteria_sql";
		return $query;
	}

	//return query based on the filter the user specified IF GPA INCLUDED
	function filter_with_gpa($filter_criteria, $and_or, $GPA, $greater_less, $selected_application_id)
	{
		require 'DMS_db.php';
		// filter applicants with gpa
		$filter_criteria_sql=implode($and_or,$filter_criteria);
		$filter_criteria_sql=$filter_criteria_sql." ".$and_or." GPA".$greater_less.$GPA;
		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);
		$sql="SELECT * FROM student_info INNER JOIN review ON student_info.user_id=review.user_id AND review.application_id=$selected_application_id  WHERE ( $filter_criteria_sql) AND student_info.user_id IN ($applicant_id_array)";
		$query= $dbc->query($sql);;
		//echo "Displaying students where $filter_criteria_sql";
		return $query;
	}
	
	//return query based on the filter the user specified IF GPA INCLUDED
	function filter_with_both_gpa($filter_criteria, $and_or, $GPA_greater, $GPA_less, $selected_application_id)
	{
		require 'DMS_db.php';
		// filter applicants with gpa
		$filter_criteria_sql=implode($and_or,$filter_criteria);
		$filter_criteria_sql=$filter_criteria_sql." ".$and_or." GPA > ".$GPA_greater." ".$and_or." GPA < ".$GPA_less;
		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);
		$sql="SELECT * FROM student_info INNER JOIN review ON student_info.user_id=review.user_id AND review.application_id=$selected_application_id  WHERE ( $filter_criteria_sql) AND student_info.user_id IN ($applicant_id_array)";
		$query= $dbc->query($sql);;
		//echo "Displaying students where $filter_criteria_sql";
		return $query;
	}

	//return query based on filter given when filter only includes gpa
	function filter_only_gpa($GPA, $greater_less, $selected_application_id)
	{
		require 'DMS_db.php';
		// filter applicants by gpa only
		$filter_criteria_sql="";
		$filter_criteria_sql=$filter_criteria_sql."GPA".$greater_less.$GPA;

		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);

		$sql="SELECT * FROM student_info WHERE $filter_criteria_sql AND user_id IN ($applicant_id_array)";

		$query= $dbc->query($sql);;

		//echo "Displaying students with GPA".$greater_less.$GPA;
		return $query;
	}
	
	function filter_both_gpa($GPA_greater,$GPA_less,$selected_application_id,$and_or)
	{
		require 'DMS_db.php';
		// filter applicants by gpa greater and gpa less
		$filter_criteria_sql="GPA >".$GPA_greater." ".$and_or." GPA <".$GPA_less;
		

		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);

		$sql="SELECT * FROM student_info WHERE ($filter_criteria_sql) AND user_id IN ($applicant_id_array)";

		$query= $dbc->query($sql);;

		//echo "Displaying students with GPA < ".$GPA_less." <b>$and_or</b> GPA > ".$GPA_greater;
		return $query;
	}
	
	
	//return query based on how user specified they want applicants to be sorted
	function doctor_sort($sort_criteria, $selected_application_id)
	{
		require 'DMS_db.php';
		//get applicant id based on sort criteria
		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);

		$sql="SELECT * FROM student_info WHERE user_id IN ($applicant_id_array) ORDER BY $sort_criteria";

		$query= $dbc->query($sql);;
		return $query;

	}

	//return quey based on user's search criteria
	function search($search_criteria, $selected_application_id)
	{
		require 'DMS_db.php';
		
		$search_criteria=$_GET['search_criteria'];
		$name_of_table=get_application_table_name($selected_application_id);
		$applicant_id_array= get_id_array($name_of_table);

		$sql="SELECT * FROM student_info WHERE
			user_id IN ($applicant_id_array) AND(
			first_name LIKE '%$search_criteria%'
			OR middle_name LIKE '%$search_criteria%'
			OR last_name LIKE '%$search_criteria%'
			OR address LIKE '%$search_criteria%'
			OR city LIKE '%$search_criteria%'
			OR state LIKE '%$search_criteria%'
			OR zip_code LIKE '%$search_criteria%'
			OR phone LIKE '%$search_criteria%'
			OR email LIKE '%$search_criteria%'
			OR degree_type LIKE '%$search_criteria%'
			OR major LIKE '%$search_criteria%'
			OR major_2 LIKE '%$search_criteria%'
			OR bilingual LIKE '%$search_criteria%')";


		$query= $dbc->query($sql);;

		//echo "Displaying students containing '$search_criteria'";
		return $query;
	if (!$query) {
		die ('SQL Error: ' . mysqli_error($dbc));
	}
	}
	
	
	function get_number_questions($application_id)
	{
		require 'DMS_db.php';
		$sql="SELECT number_unique_questions FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		
		return (int)$application['number_unique_questions'];
		
	}
	
	//this will return the answer that an applicant gave to a particular question
	function answer_unique_question($number_unique_questions, $application_id, $user_id)
	{
		require 'DMS_db.php';
		
		$name_of_table=get_application_table_name($application_id);
		$question="question_".$number_unique_questions;
		$sql="SELECT $question FROM $name_of_table WHERE user_id='".$user_id."'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$applicant= $stmt->fetch();
		
		return $applicant["$question"];
		
	}
	
	function question_unique_question($application_id, $number_unique_questions)
	{
		require 'DMS_db.php';
		
		$sql="SELECT list_unique_questions FROM applications WHERE application_id=$application_id";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application= $stmt->fetch();
		
		$list_unique_questions=$application['list_unique_questions'];
		$array_unique_questions=explode('(#!BREAK!#)', $list_unique_questions);
		
		return $array_unique_questions[$number_unique_questions];
		
	}
	
	function select_student_review($user_id, $application_id)
	{
		require 'DMS_db.php';
		
		$sql="SELECT * FROM review WHERE application_id=$application_id AND user_id='".$user_id."'";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$review= $stmt->fetch();
		
		return $review;
	}


?>
