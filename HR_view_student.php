<?php
//DISPLAYS STUDENT INFORMATON FOR THE SPECIFIED STUDENT 
//ALSO ALLOWS USER TO CHANGE INFORMATION ON THE STUDENT (WORKING FOR DMS OR NOT/ HOURS/ PAY)
//BY POSTING INFO TO HR_working_for_dms
require "DMS_general_functions.php";
	$role_id_array=array("3","1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	if ($_SESSION['role']=='1')
	{
		require "admin_header.html";
	}
	elseif($_SESSION['role']=='3')
	{
		require "HR_header.html";
	}?>


  <!-- Header -->
<div class="w3-container" style="margin-top:40px; font-familt:benton sans;" id="showcase">
	<h1 class="w3-jumbo">
		<b>Program Applicant</b>
	</h1>

	<hr style="min-width:100%;border:5px solid #BF5700" align="left" class="w3-round">
	<br>
	<b> </b>
	<br>
	<br>
</div>
</html>
<?php
require 'DMS_db.php';

//this will display an error message if the user tries to accept a student already accepted in the database

//echo "<form action='DOCTOR_update_review.php' method='POST'">

// Get ID from the URL
$id = $_GET['id'];

//$result = mysqli_query($dbc, "SELECT * FROM application WHERE ApplicationID = '$id'");
$result = "SELECT * FROM student_info WHERE user_id = '$id'";

$query= $dbc->query($result);


$query= $dbc->query($result);;

if (!$query) {
	die ('SQL Error: ' . mysqli_error($dbc));
}

echo "<form action='HR_dashboard.php' method='get'>
	 <input type='submit' style='background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;' value='Return to list' />
	 <input type='hidden' name=user_id value=$id>
	</form>"

?>
<form action='HR_working_for_dms.php' method='post'>
<input type="hidden" name="user_id" value=<?php echo $id ?>>
<!--<table width=100% table border>-->
<tr>

</tr>

<table class="data-table2">

<?php
if ($_SESSION['role']=='1')
{
	$disabled='disabled';
}
else
{
	$disabled="";
}

//while($row = mysqli_fetch_array($result))
while ($row=$query->fetch(PDO::FETCH_ASSOC))
{

echo "<tr><thead>";
echo "<th>ID</th>";
echo "<td>" . $row['user_id'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>First Name</th>";
echo "<td>" . $row['first_name'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Middle Name</th>";
echo "<td>" . $row['middle_name'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Last Name</th>";
echo "<td>" . $row['last_name'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Email</th>";
echo "<td>" . $row['email'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Address</th>";
echo "<td>" . $row['address'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>City</th>";
echo "<td>" . $row['city'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>State</th>";
echo "<td>" . $row['state'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Zip Code</th>";
echo "<td>" . $row['zip_code'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Phone Number</th>";
echo "<td>" . $row['phone'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Employment</th>";
echo "<td>" . $row['employment'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Classification</th>";
echo "<td>" . $row['classification'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Student Type</th>";
echo "<td>" . $row['student_type'] .  "</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Degree Type</th>";
echo "<td>" . $row['degree_type'] .  "</td>";
echo "</tr>";

/*echo "<tr>";
echo "<th>Major</th>";
echo "<td>" . $row['major'] .  "</td>";
echo "</tr>";

if ($row['major_2']=='')
{
	$major_2="None";
}

echo "<tr>";
echo "<th>Second Major</th>";
//echo "<td>" . $row['major_2'] .  "</td>";
if (isset($major_2)){
echo "<td>$major_2</td>";}
echo "</tr>";
*/

echo "<tr>";
echo "<th>Credit Hours Enrollment</th>";
echo "<td>" . $row['credit_hours'] .  " credit hours</td>";
echo "</tr>";

if ($row['worked_at_dms']==0)
{
	$worked_at_dms="No";
}
else{
	$worked_at_dms="Yes";
}

echo "<tr>";
echo "<th>Has worked at DMS before?</th>";
//echo "<td>" . $row['worked_at_dms'] .  "</td>";
echo "<td>$worked_at_dms</td>";
echo "</tr>";

if ($row['volunteered_at_seton']==0)
{
	$volunteered_at_seton="No";
}
else{
	$volunteered_at_seton="Yes";
}

echo "<tr>";
echo "<th>Has volunteered at Seton before?</th>";
//echo "<td>" . $row['volunteered_at_seton'] .  "</td>";
echo "<td>$volunteered_at_seton</td>";
echo "</tr>";

if ($row['car']==0)
{
	$car="No";
}
else{
	$car="Yes";
}

echo "<tr>";
echo "<th>Has a car?</th>";
//echo "<td>" . $row['car'] .  "</td>";
echo "<td>$car</td>";
echo "</tr>";

echo "<tr>";
echo "<th>Hours Working</th>";
//echo "<td>" . $row['hours_working_week'] .  " hours/week</td>";
//echo "<td><input type='text' name='hours_working_week' value='$row['hours_working_week']'</td>";
echo '<td><input type="text" name="hours_working_week" value="'.$row['hours_working_week'].'"'. $disabled.'></td>';
echo "</tr>";

echo "<tr>";
echo "<th>Hourly Rate</th>";
//echo "<td>$" . $row['hourly_rate'] .  "/hour</td>";
echo '<td><input type="text" name="hourly_rate" value="'.$row['hourly_rate'].'"'.$disabled.' ></td>';
echo "</tr>";

//This will allow the checkbox to be checked if the value =1 and unchecked if the value = 0
$working_for_dms = $row['working_for_dms'];
if($working_for_dms == 1)
{
	$checked = 1;
	$check= 'checked="checked"';
}
else
{
	$checked = 0;
	$check= '';
}

echo "<tr>";
echo "<th>Working for DMS?</th>";

echo '<td><input type="checkbox" name="new_working_for_dms" value="1" '.$check.' '.$disabled.'></td>';
echo '<input type="hidden" name="user_id" value='.$row['user_id'].'>';
//echo "</tr>"Check<br/>;

//


/* echo "<tr>";
echo "<th>Review</th>";

$stmt = $dbc->query("SELECT review FROM student_info WHERE user_id=$id;");
        $x = $stmt->fetch();

		if ($x['review']=="2") //if review = 2 (Competitive) in the db, show the correct selected value
		{
			echo '<td><select name="new_review">
				<option value="review = 0 WHERE user_id='.$row['user_id'].'">N/A</option>
				<option value="review = 1 WHERE user_id='.$row['user_id'].'">Noncompetitive</option>
				<option value="review = 2 WHERE user_id='.$row['user_id'].'" selected="selected">Competitive</option>
			</select></td>';
		}
		elseif ($x['review']=="1") //if review = 1 (Noncompetitive) in the db, show the correct selected value
		{
			echo'<td><select name="new_review">
				<option value="review = 0 WHERE user_id='.$row['user_id'].'">N/A</option>
				<option value="review = 1 WHERE user_id='.$row['user_id'].'" selected="selected">Noncompetitive</option>
				<option value="review = 2 WHERE user_id='.$row['user_id'].'">Competitive</option>
			</select></td>';
		}
		else{ //if review = 0 (N/A) in the db, show the correct selected value
			echo '<td><select name="new_review">
				<option value="review = 0 WHERE user_id='.$row['user_id'].'"selected="selected">N/A</option>
				<option value="review = 1 WHERE user_id='.$row['user_id'].'">Noncompetitive</option>
				<option value="review = 2 WHERE user_id='.$row['user_id'].'">Competitive</option>
			</select></td>';
		}

echo "</tr>"; */


//echo "<br>"

echo "</tr>";
}

//$result1 = "SELECT question_0 FROM 11_Mobile_Research_Fall_2018 WHERE user_id='$id'";
//$query1= $dbc->query($result1);

/* while ($row=$query1->fetch(PDO::FETCH_ASSOC))
{

echo "<tr>";
echo "<th>Question1</th>";
echo "<td>" . $row['question_0'] .  "</td>";
echo "</tr>";
echo "</table>"; */

//}
//echo "<form action='DOCTOR_update_review.php' method='POST' onsubmit= return confirm('Are you sure you want to submit changes?');>

/* echo "
<td><br></td>
<td><br></td>
<tr><td></td>
<td></td>
<td><input type='checkbox' name='new_accepted_by_DMS' value='1'> Check to Accept Applicant<br />
<input type='hidden' name='user_id' value=$id><br /></td></tr>
<tr><td></td>
<td></td>"; */

?>
</table>

<tr><td><br></td>

<?php if ($_SESSION['role']=='3'): ?>
<td><input type='submit' name= "save" value='Save Changes' onclick="return confirm('Are you sure you want to SAVE changes?')"style="background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;"></td><tr>
<?php endif; ?>

<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
<td><br></td>
</form>
</body>
</html>
