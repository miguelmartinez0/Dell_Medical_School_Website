<?php
//THIS IS THE PAGE THAT ALLOWS A STUDENT TO ACCEPT OF DECLINE THEIR OFFER
//WILL DISPLAY WHAT DAY THEIR OFFER WILL EXPIRE (ACCEPTANCE DATE + 14 DAYS)
//ONLY WORKS IF BEFORE EXPIRE DATE, OTHERWISE REDIRECTS TO THE OFFER EXPIRED PAGE
//WHEN THEY ACCEPT OR DECLINE, COMMAND EXECUTED THROUGH STUDENT_accept_decline_offer

	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";
	$user_id=$_SESSION['user_id'];
	require "STUDENT_header.html";

	date_default_timezone_set('America/Chicago');



	require "STUDENT_functionality.php";



	$application_id=$_GET['application_id'];

	$application = select_application($application_id);

	$date= get_application_accept_date_not_formatted($user_id, $application_id);

	$deadline= date('Y-m-d', strtotime($date. ' + 14 days'));

	/* $current_date = date('m/d/Y h:i:s a', time());
	echo $current_date; */

	$current_date=date('Y-m-d');


	if ($current_date > $deadline)

	$deadline= date('Y-m-d', strtotime($date. ' + 14 days'));

	$current_date=date('Y-m-d');


	if ($current_date > $deadline)

	{



		header("Location: STUDENT_offer_expired.php?application_id=$application_id");
		die();
	}

	elseif(get_accepted_offer($user_id, $application_id)=="1")
	{
		header("Location: STUDENT_dashboard.php?message=1");
		die();
	}

?>
  <!-- Header -->
<div class="w3-container" style="margin-top:40px" id="showcase">
	<h1 class="w3-jumbo">
		<b>Accept your offer </b>
	</h1>


	<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
	<br>
	<b><u>You have until
		<?php
			echo date("m-d-Y", strtotime($deadline));

		?>
	to acccept your offer</u></b>
	<br>
	<br>
</div>

<div class="w3-container" id="application" style="margin-top:10px">

<body>
<p>You are being offered an internship position with the <?php echo get_program_from_app_id($application_id) ?> program.
This is <?php if($application['position_type']=='Non-Paid'){ echo 'not'; } ?> a paid position. Please accept of decline your offer below.</p>


<form name="STUDENT_accept_decline_offer.php" action="STUDENT_accept_decline_offer.php" method="post">
	<input type="hidden" name="user_id" value="<?php echo $user_id?>"/>
	<input type="hidden" name="application_id" value="<?php echo $application_id?>"/>

	<input type="submit" name="accept" value="Accept" onclick="return confirm('Are you sure you want to ACCEPT this offer?')">
	<input type="submit" name="decline" value="Decline" onclick="return confirm('Are you sure you want to DECLINE this offer?')">
</form>
