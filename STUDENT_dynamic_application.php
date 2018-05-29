<?php
//DISPLAYS THE UNIQUE QUESTIONS FOR THE CHOSEN APPLICATION FOR USER TO ANSWER AND Submit
//EXECUTES THROUGH STUDENT_dynamic_application_connect
//QUESTIONS PULLED BY STUDENT_dynamic_application_functionality
	require "DMS_general_functions.php";
	$role_id_array=array("5");
	require "DMS_authenticate.php";
	require 'STUDENT_dynamic_application_functionality.php';
	require "STUDENT_header.html";
	$user_id=$_SESSION['user_id'];
?>
  <!-- Header -->
<div class="w3-container" style="margin-top:40px" id="showcase">
	<h1 class="w3-jumbo">
		<b><?php echo $name_of_program ?></b>
	</h1>

	<hr style="width:800px;border:5px solid #BF5700" class="w3-round">

</div>
<div class="w3-container" id="application" style="margin-top:10px">

<body>



	<!--this form will post to DMS_connect in order to submit data to DB-->
	<form name="apply_form" action = "STUDENT_dynamic_application_connect.php" method= "post" onsubmit="return confirm('Are you sure you want to submit?');">
		<input type="hidden" name="application_id" value="<?php echo $application_id?>"/>

		<table>

<?php

				foreach($array_unique_questions as $key=>$value)
				{
					echo "<div>";
					echo "<p>$value<p>";
					echo "<textarea class='written' placeholder='Please enter your response here' name='question_$key' rows='10'
					cols'800' required></textarea><br>";
					echo '</div>';
				}


?>
		<tr><br>
			<br>
			<td><p style="font-size:150%;">I certify that all the information provided by me in connection with my application, whether on this document or not, is true and complete, and I understand that any misstatement, falsification, or omission of information shall be grounds for refusal to hire or, if hired, termination. I understand any current or former employment at The University of Texas at Austin must be disclosed on my application. I understand that any offer of employment is contingent upon my agreement to abide by the rules and regulations of The Board of Regents of The University of Texas System.</p><p style="font-size:150%;">I hereby authorize The University of Texas at Austin or any law enforcement agency to furnish to The University of Texas at Austin my criminal conviction record for a deferred adjudication, misdemeanor or felony offense at age 17 or older. I do hereby release all agents, servants, and employees of UT Austin, the person in charge of such law enforcement agency or department and all members of such law enforcement agency or department from all liability resulting from the furnishing of this information to The University of Texas at Austin.</p>

<p style="font-size:150%;">I authorize The University of Texas at Austin to communicate with persons listed as references, former employers, and any others with whom you desire to check. I agree to hold such persons harmless with respect to any information they may give about me.</p>

		</tr>

		<tr>
			<td><input type="checkbox" name="terms" value="1" required style="font-size:150%;"> I agree to the terms and conditions<br></td>
		</tr>



		</table>
		<br><br>
		<!--submit button. Will post info.-->
		<td colspan="1" style="text-align: center; float: center;"><input type="submit" value="Submit" style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;" name="submit"/> </td>
		*Once you submit this form you will not be able to change your answers
		</form>
		<script>
		//function to limit the amount of characters in textarea
		$("textarea").keyup(function()
			{
				var words = this.value.match(/\S+/g).length;
				if (words > 500) {
				// Split the string on first 500 words and rejoin on spaces so that any words past 500 are cut off
				var trimmed = $(this).val().split(/\s+/, 500).join(" ");
				// Add a space at the end to make sure more typing creates new words to work in this function
				$(this).val(trimmed + " ");
			}
		});
</script>
</body>
</html>
