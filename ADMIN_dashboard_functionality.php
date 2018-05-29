<?php
//THIS IF THE FILE THAT PULLS THE INFORMATION ON ALL CURRENTLY OPEN PROGRAMS AND HOW MANY APPLICANTS EACH HAS IN ORDER TO BE DISPLAYED ON ADMIN_DASHBOARD

	//function returns query to get all applications that are open
	function get_application_info()
	{
		require 'DMS_db.php';

		$sql = 'SELECT * FROM applications WHERE application_closed=0 AND archived="FALSE" ORDER BY application_id DESC';

		$query= $dbc->query($sql);;
		return $query;
	}
	
	//returns the number of applicants that a specified application has
	function count_applicants($name_of_table)
	{
		require 'DMS_db.php';
		
		//get a count of all applicants in the table
		$sql="SELECT COUNT(*) as number_of_applicants from $name_of_table";
		$stmt=$dbc->prepare($sql);
		$stmt->execute();
		$application=$stmt->fetch();
		
		return $application;
	}

	
	


?>