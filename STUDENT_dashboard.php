<?php
//STUDENT DASHBOARD IS WHERE STUDENT ROLES BROUGH ON LOGIN
//DISPLAYS TABLE WITH ALL APPLICATIONS A STUDENT HAS APPLIED TO AND SHOWS
//THE STATUS OF THAT (ACCEPTED, OFFER ACCEPTED, DECLINED, OR BLANK)
//IF ACCEPTED, THEN LINK TO STUDENT_accept_offer SO THAT THEY MAY ACCEPT OR DECLINE THEIR OFFER

require "DMS_general_functions.php";
$role_id_array=array("5");
require "DMS_authenticate.php";
$user_id = $_SESSION['user_id'];
require "STUDENT_header.html";
?>
<?php


	date_default_timezone_set('America/Chicago');


	require "STUDENT_functionality.php";


	if (isset($_GET['message']))
	{
		if ($_GET['message']=="1")
		{
			echo '<script language="javascript">';
			echo 'alert("You have already responded to this offer")';
			echo '</script>';
		}
		elseif($_GET['message']=="2")
		{
			echo '<script language="javascript">';
			echo 'alert("You have successfully accepted your offer")';
			echo '</script>';
		}
		elseif($_GET['message']=="3")
		{
			echo '<script language="javascript">';
			echo 'alert("You have successfully declined your offer")';
			echo '</script>';
		}

		elseif ($_GET['message']=="6"){
			echo '<script language="javascript">';
			echo 'alert("The password was successfully changed")';
			echo '</script>';
		}



	}
?>
  		<!-- Header -->
<div class="w3-container" style="margin-top:50px; font-familt:benton sans;" id="showcase">
	<h1 class="w3-jumbo">

	</h1>

	<hr style="min-width:100%;border:5px solid #BF5700" align="left" class="w3-round">



		<br>
			<b>You have applied to the following programs. If you would like to apply to another program, click the "New Application" tab on the navigation bar.
			</b>
		<br>
		<br>
		</div>



		<table class="data-table">

			<thead>
				<tr>

					<th>Program</th>
					<th>Term</th>
					<th>Year</th>
					<th>Application Submit Date</th>
					<th>Status</th>
				</tr>
			</thead>


		<?php

			$application_array=get_applications_student_applied_to($user_id);
			//check if a student has already accepted another offer or not
			$already_accepted_offer=check_student_accepted_offer();

			foreach($application_array as $row)
				{
					//call function get_program from DMS_general_functions to get the program name
					echo '<tr><td>'.get_program($row['program_id']).'</td>
						<td>'.$row['term'].'</td>
						<td>'.$row['year'].'</td>
						<td>'.get_application_submit_date($user_id, $row['application_id']).'</td>';

						if (get_accepted_declined_offer($user_id, $row['application_id'])=="0")
						{
							echo '<td>Offer Declined</td>
							</tr>';
						}
						elseif(get_accepted_declined_offer($user_id, $row['application_id'])=="1")
						{
							echo '<td>Offer Accepted</td>
							</tr>';

						}
						else
						{
							if ($already_accepted_offer=="FALSE")
							{
								echo '<td><a href="STUDENT_accept_offer.php?&application_id='.$row['application_id'].'">'.get_accepted($user_id, $row['application_id']).'</a></td>
								</tr>';
							}
							//if a student has already accepted an offer, they do not get a link to accept any offers
							elseif($already_accepted_offer=="TRUE")
							{
								echo '<td>'.get_accepted($user_id, $row['application_id']).'</td>
								</tr>';
							}
							else
							{
								echo "<td>$already_accepted_offer</td>";
							}

						}


				}

		?>

		</table>
