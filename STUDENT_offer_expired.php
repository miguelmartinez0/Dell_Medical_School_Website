<?php
//IF A STUDENTS OFFER HAS EXPIRED(THIS HAPPENS 14 DAYS AFTER ACCEPTANCE), THEY ARE TAKEN TO THIS PAGE WHEN THEY CLICK "ACCEPTD" LINK ON THEIR STUDENT_dashboard
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";

	date_default_timezone_set('America/Chicago');

	require "STUDENT_functionality.php";
	require "STUDENT_header.html";
	$user_id=$_SESSION['user_id'];
	$application_id=$_GET['application_id'];

?>
<div class="w3-container" style="margin-top:40px" id="showcase">
	<h1 class="w3-jumbo">
		<b>Accept your offer </b>
	</h1>


	<hr style="width:800px;border:5px solid #BF5700" class="w3-round">
	<br>
	<b><u>Your offer expired on
		<?php
			//get the date of acceptance from the database
			$date= get_application_accept_date_not_formatted($user_id, $application_id);

			//set the deadline of acceptance and echo to user
			$deadline=date('Y-m-d', strtotime($date. ' + 14 days'));
			echo date("m-d-Y", strtotime($deadline));
		?> </u></b>
	<br>
	<br>
</div>
