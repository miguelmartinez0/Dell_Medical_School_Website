<?php
//ALL FUNCTIONS THAT ARE USED ACROSS THE HR PAGES
//$role_id_array=array("3","1");
//require "DMS_authenticate.php";
require 'DMS_db.php';



function filter($filter_criteria, $and_or)
{
	require 'DMS_db.php';
	//filtering accepted applicants with selected criteria
	$filter_criteria_sql=implode($and_or,$filter_criteria);

	$sql="SELECT * FROM student_info INNER JOIN review ON student_info.user_id=review.user_id WHERE student_accept_offer='1' AND ($filter_criteria_sql) ORDER BY working_for_dms DESC";

	$query= $dbc->query($sql);;

	//echo "Displaying students where $filter_criteria_sql";
	return $query;
}


function search($search_criteria)
{
	require 'DMS_db.php';
	//perform search based on HR selected criteria
	$search_criteria=$_GET['search_criteria'];

	$sql="SELECT * FROM student_info  INNER JOIN review ON student_info.user_id=review.user_id WHERE student_accept_offer='1' AND(
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
		OR major_2 LIKE '%$search_criteria%')
		ORDER BY working_for_dms DESC";
	$query= $dbc->query($sql);;

	//echo "Displaying students containing '$search_criteria'";
	return $query;

	//error handing
	if (!$query)
	{
		die ('SQL Error: ' . mysqli_error($dbc));
	}
}	

function view_all(){
	require 'DMS_db.php';
	
	$sql="SELECT * FROM student_info INNER JOIN review ON student_info.user_id=review.user_id WHERE student_accept_offer='1' ORDER BY working_for_dms DESC";
	$query= $dbc->query($sql);;
	return $query;
}
function get_program_type($program_id)
{
	require 'DMS_db.php';
	
	$sql="SELECT name_of_program, position_type FROM programs WHERE program_id=$program_id";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$program= $stmt->fetch();
	return $program['position_type'];
}

function get_position_type($program_id)
	{
		require 'DMS_db.php';
	
		$sql="SELECT position_type FROM programs WHERE program_id=$program_id";
		$query= $dbc->query($sql);
		return $query;
	}

	function select_student($user_id)
	{
		require 'DMS_db.php';
		
		$sql="SELECT * FROM student_info WHERE user_id=".$user_id;
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$student= $stmt->fetch();
		
		return $student;
	}
	
function get_review_entry($user_id)
{
	require 'DMS_db.php';
	$sql="SELECT * FROM review WHERE user_id='".$user_id."' AND accepted_by_dms='1' AND student_accept_offer='1'";
	$stmt=$dbc->prepare($sql);
	$stmt->execute();
	$review= $stmt->fetch();
		
	return $review;
}
?>
