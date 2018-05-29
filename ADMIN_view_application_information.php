<?php
//PAGE FOR ADMIN TO VIEW SPECIFIC APPLICATION INFORMATON WHEN THEY CLICK ON THE ID LINK IN EITHER:
//ADMIN_dashboard, ADMIN_view_archived_applications, OR ADMIN_view_all_active_applications
//THROUGH THIS FROM, ADMIN CAN CLOSE, OPEN, ARCHIVE, OR UNARCHIVE AN APPLICATION DEPENDING ON THE APPLICATION'S CURRENT STATUS

	require 'DMS_general_functions.php';
	$role_id_array=array("1");
	require "DMS_authenticate.php";
	$user_id = $_SESSION['user_id'];
	require "admin_header.html";
	//require 'ADMIN_add_doctor_to_application_functionality.php';
?>
				<!-- Header -->
				<div class="w3-container" style="margin-top:40px" id="showcase">
					<h1 class="w3-jumbo">
						<b>Application Information</b>
					</h1>
					<hr style="width:800px;border:5px solid #BF5700" align="left" class="w3-round">
				</div>
				<div class="w3-container" id="application" style="margin-top:10px"></div>
<body>
<?php

	require 'DOCTOR_functionality.php';


	// Get ID from the URL
	$application_id = $_GET['id'];

	//Calls select_application2 function from DOCTOR_functionality.php
	$query=select_application2($application_id);



	echo "<table class='data-table2'>";
	//echo "<table class=view-table>

	echo "<tr></tr>";
	//while($row = mysqli_fetch_array($result))
	while ($row=$query->fetch(PDO::FETCH_ASSOC))
	{
		$program_id = $row['program_id'];

		//Calls get_program function from DMS_general_functions.php
		$name_of_program = get_program($program_id);

		//get the list of questions and turn into an array
		$list_unique_questions = $row['list_unique_questions'];
		$array_unique_questions=explode('(#!BREAK!#)', $list_unique_questions);

		//convert applcation closed value to words
		//0 is false 1 is true
		if ($row['application_closed']==0)
			{
				$application_closed="Yes";
			}
		else
			{
				$application_closed="No";
			}

		// Display application's ID
		echo "<tr><thead>";
		echo "<th>ID</th>";
		echo "<td>" . $row['application_id'] .  "</td>";
		echo "</tr>";

		// Display appliction's Name
		echo "<tr>";
		echo "<th>Program</th>";
		echo "<td>" . $name_of_program .  "</td>";
		echo "</tr>";

		// Display applications's Term
		echo "<tr>";
		echo "<th>Term</th>";
		echo "<td>" . $row['term'] .  "</td>";
		echo "</tr>";

		// Display applications's Year
		echo "<tr>";
		echo "<th>Year</th>";
		echo "<td>" . $row['year'] .  "</td>";
		echo "</tr>";

		//loop through the array of questions and display all unique questions
		echo "<tr>";
		echo "<th>Questions</th>";

		foreach($array_unique_questions as $key=>$value)
		{
			if ($key==0)
				{
					echo "<td>$value</td>";
				}
			else
				{
					echo "<tr><td></td>";
					echo "<td>$value</td></tr>";
				}
		}




		//break
		if ($row['archived']=="FALSE")
			{
				// Display whether or not the applications is open or closed
				echo "<tr>";
				echo "<th>Open?</th>";
				echo "<td>" . $application_closed.  "</td>";

				echo "</tr>";
				echo "</tr></table>";

				//set variable to change whether she can close or open an application
				//0 is false 1 is true
				if ($application_closed=="No")
				{
					$close_open="Open";
					$value="0";
				}
				else
				{
					$close_open="Close";
					$value="1";
				}

				echo "<form action='ADMIN_close_application_connect.php' method='POST'>

					<tr>
						<td></td>
						<td></td>
						</br>
						<td><input type='checkbox' name='new_close_application' id='close_open' value=$value> Check to $close_open Application
						<input type='hidden' name='application_id' value=$application_id></td>
						<td>&nbsp&nbsp&nbsp&nbsp&nbsp<input type='checkbox' name='new_archive_application' id='archive' value=$value> Check to Archive Application<br />
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type='submit' id='close_open_submit' style='background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;' value=' Enter ' disabled></td>
						<td><input type='submit' id='archive_submit' style='background-color:#bf5700;color:white;text-shadow: #000 0px 0px 1px;' value=' Archive ' disabled></td>
					</tr>
					</form>";

				echo "</table>";
			}

	else
		{
			echo "This application is archived";
			echo "<form action='ADMIN_close_application_connect.php' method='POST'>";


			// Display whether or not the applications is open or closed
			echo "<tr>";
			echo "<th>Open?</th>";
			echo "<td>" . $application_closed.  "</td>";

			echo "</tr>";
			echo "</tr></table>";

			//set variable to change whether she can close or open an application
			//0 is false 1 is true
			if ($application_closed=="No")
			{
				$close_open="Open";
				$value="0";
			}
			else
			{
				$close_open="Close";
				$value="1";
			}






			echo "<tr><br></tr>";
			echo "<tr><td><input type='checkbox' id='unarchive' name='unarchive_application' value=$value> Check to Unarchive Application<br />
						<input type='hidden' name='application_id' value=$application_id><br /></td></tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type='submit' id='unarchive_submit' value=' Enter ' disabled></td></tr>
				</form>";
			echo "</table>";

		}
	}

?>


<a href="ADMIN_add_doctor_to_application.php?select_application=<?php echo $application_id ?>">Edit who can view applicants</a>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<script type="text/javascript">
			<!--//--><![CDATA[//><!--
			window.jQuery || document.write("<script src='/sites/all/modules/custom/utexas_admin/js/replace/backup/jquery.min.js'>\x3C/script>")
			//--><!]]>
			</script>
			<script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_V1ZuwJK9uzfm6fFffOcHHubfxnimoxnbgG58pvTQdpY.js"></script>
			<script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_i8ZDNK9FSclaojQobXVjwcDgllxkCNEBi7F9dR3cyG4.js"></script>
			<script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_OQYJ-u6vDcK-675deS5Xo9mquqU3gecqRovKlzqWxgo.js"></script>
			<script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_RrQc6CubqbOf8B1FDFLiOZd89DCZo5HaON0Jzve9S38.js"></script>
			<script type="text/javascript">
			<!--//--><![CDATA[//><!--
			jQuery.extend(Drupal.settings, {"basePath":"\/","pathPrefix":"","ajaxPageState":{"theme":"dms","theme_token":"ldwKYvqbNm9QvvSHqmM1baDbR7Wu4H0dVqepI3Y2hxU","js":{"https:\/\/ajax.googleapis.com\/ajax\/libs\/jquery\/1.10.2\/jquery.min.js":1,"0":1,"misc\/jquery.once.js":1,"misc\/drupal.js":1,"sites\/all\/libraries\/magnific-popup\/dist\/jquery.magnific-popup.js":1,"sites\/all\/modules\/contrib\/magnific_popup\/js\/behaviors.mfp-formatter.js":1,"sites\/all\/modules\/custom\/utexas_google_cse\/js\/utexas_google_cse.js":1,"sites\/all\/themes\/phase2_theme1\/js\/custom.js":1,"sites\/all\/themes\/dms\/js\/fitvids.js":1,"sites\/all\/themes\/dms\/js\/dmscustom.js":1},"css":{"modules\/system\/system.base.css":1,"modules\/system\/system.menus.css":1,"modules\/system\/system.messages.css":1,"modules\/system\/system.theme.css":1,"sites\/all\/libraries\/magnific-popup\/dist\/magnific-popup.css":1,"sites\/all\/modules\/contrib\/magnific_popup\/css\/mfp-formatter.css":1,"sites\/all\/modules\/contrib\/calendar\/css\/calendar_multiday.css":1,"sites\/all\/modules\/custom\/features\/content_types\/content_type_twitter_widget\/theme\/twitter-widget.css":1,"sites\/all\/modules\/contrib\/date\/date_api\/date.css":1,"sites\/all\/modules\/contrib\/date\/date_popup\/themes\/datepicker.1.7.css":1,"sites\/all\/modules\/custom\/features\/bundles\/featured_media\/theme\/featured_media.css":1,"modules\/field\/theme\/field.css":1,"sites\/all\/modules\/custom\/localist_integration\/css\/localist.css":1,"modules\/node\/node.css":1,"modules\/search\/search.css":1,"modules\/user\/user.css":1,"sites\/all\/modules\/custom\/utexas_fonts\/css\/fonts.css":1,"sites\/all\/modules\/custom\/utexas_google_cse\/css\/utexas_google_cse.css":1,"sites\/all\/modules\/custom\/features\/views\/views_core_home_featured_stories\/theme\/core-home-featured-stories.css":1,"sites\/all\/modules\/custom\/features\/views\/views_utexas_localist_widget\/theme\/utexas-localist-widget.css":1,"sites\/all\/modules\/contrib\/views\/css\/views.css":1,"sites\/all\/modules\/contrib\/ckeditor\/css\/ckeditor.css":1,"sites\/all\/modules\/contrib\/ctools\/css\/ctools.css":1,"sites\/all\/modules\/contrib\/oembed\/oembed.base.css":1,"sites\/all\/modules\/contrib\/oembed\/oembed.theme.css":1,"0":1,"1":1,"sites\/all\/themes\/phase2_theme1\/css\/base.css":1,"sites\/all\/themes\/phase2_theme1\/css\/phase2_pages.css":1,"sites\/all\/themes\/phase2_theme1\/css\/phase2_theme1.css":1,"sites\/all\/themes\/dms\/css\/custom.css":1,"sites\/all\/themes\/dms\/css\/overrides.css":1}},"cseId":"015663220751118638721:x0c8u6cfbrm","magnific_popup_api":{"iframe_patterns":{"youtube":{"index":"youtube.com\/","id":"v=","src":"\/\/www.youtube.com\/embed\/%id%?rel=0\u0026modestbranding=1\u0026playerapiid=mfp-iframe\u0026controls=2\u0026autoplay=1"}}}});
			//--><!]]>
			</script>
			  <script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_9xSy2jfgzGVpfqWMRbersAVIjfBizP0C9bnfdzuyJPo.js"></script>
			<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			    <div class="region region-page-bottom">
			    <!-- Google Tag Manager -->
			<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-59NMNV"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-59NMNV');




		$("#close_open").click(function(){
			if (this.checked) {
				$('#close_open_submit').prop('disabled', false);
			}
			else{
				$('#close_open_submit').prop('disabled', true);
			}

		});

		$("#archive").click(function(){
			if (this.checked) {
				$('#archive_submit').prop('disabled', false);
			}
			else{
				$('#archive_submit').prop('disabled', true);
			}

		});

		$("#unarchive").click(function(){
			if (this.checked) {
				$('#unarchive_submit').prop('disabled', false);
			}
			else{
				$('#unarchive_submit').prop('disabled', true);
			}

		});



			</script>
			<!-- End Google Tag Manager -->  </div>
			</body>
					</html>
