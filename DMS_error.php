<?php 
//ERROR PAGE
//LINKS BACK TO USER'S DASHBOARD

session_start();
	
if (isset($_SESSION['role']))
{	
	if($_SESSION["role"]=="5")
	{
		header("STUDENT_dashboard.php");
		
	}
	elseif($_SESSION["role"]=="4")
	{
		$here="DOCTOR_potential_student_table.php";
		
	}
	elseif($_SESSION["role"]=="3")
	{
		$here="HR_dashboard.php";
		
	}
	elseif($_SESSION["role"]=="2")
	{
		$here="DOCTOR_dashboard.php";
		
	}
	elseif($_SESSION["role"]=="1")
	{
		$here="ADMIN_dashboard.php";
		
	}
	else
	{
		$here="DMS_login.php";
		
	}
}

	else
	{
		$here="DMS_login.php";
		
	}
	  
	
	  
	  ?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
	<link href='./application.css' type='text/css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
</head>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="apple-touch-icon" sizes="180x180" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-180x180.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-152x152.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-144x144.png" />
	<link rel="icon" href="/sites/all/themes/phase2_theme1/img/favicon/favicon.ico" />
	<!--[if IE]><link rel="shortcut icon" href="/sites/all/themes/phase2_theme1/img/favicon/favicon.ico" />
	<![endif]--><meta name="apple-mobile-web-app-title" content="UT Austin" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="msapplication-TileImage" content="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-144x144.png" />
	<meta name="msapplication-TileColor" content="#bf5700" />
	<link rel="apple-touch-icon" sizes="120x120" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="57x57" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="60x60" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="/sites/all/themes/phase2_theme1/img/favicon/apple-touch-icon-72x72.png" />
	<meta name="description" content="Dell Medical School at The University of Texas at Austin is the first med school in decades to be built from the ground up at a Tier 1 research university." />
	<meta name="robots" content="follow, index" />
	<meta name="generator" content="Drupal 7 (http://drupal.org)" />
	<link rel="canonical" href="https://dellmed.utexas.edu" />
	<link rel="shortlink" href="https://dellmed.utexas.edu" />
	<title>Dell Medical School | The University of Texas at Austin</title>
	<link type="text/css" rel="stylesheet" href="https://dellmed.utexas.edu/sites/default/files/css/css_xE-rWrJf-fncB6ztZfd2huxqgxu4WO-qwma6Xer30m4.css" media="all" />
	<link type="text/css" rel="stylesheet" href="https://dellmed.utexas.edu/sites/default/files/css/css_tKJ8QKUw8OLBfSpVi3r2kqhI0EM9KvnZzuv9rNVL1dE.css" media="all" />
	<link type="text/css" rel="stylesheet" href="https://dellmed.utexas.edu/sites/default/files/css/css_ObkY4Fv7biAuohhzB1p-hgy32GQxKG4rzg9E0b42Xo0.css" media="all" />
	<link type="text/css" rel="stylesheet" href="https://dellmed.utexas.edu/sites/default/files/css/css_YytGlvj-rOSj7aCuw23k0KHgv0uW_7b2NUNxl_vdSsM.css" media="all" />
	<link type="text/css" rel="stylesheet" href="DMS_Stylesheet.css" media="all" />
	<style type="text/css" media="all">
		/*--><![CDATA[/*><!--*/
		#main-nav li a{font-family:open_sans;}
		.UT-page{margin-top:50px;}
		/*]]>*/
	</style>
	<link type="text/css" rel="stylesheet" href="https://dellmed.utexas.edu/sites/default/files/css/css_a-iX8Z0TGtqOTsvj7qkSGIxcKy1DQVow38xs9TgeR0g.css" media="all" />
	<script type="text/javascript" src="https://dellmed.utexas.edu/sites/default/files/js/js_nGsGFAVr6D4cI4gpxlZHFJ7PJaRNEW3-0MdbO3ITML0.js"></script>
</head>

<body class="html front not-logged-in no-sidebars page-node"  >
	<div id="skip-link">
		<a href="#ut-page-content" class="element-invisible element-focusable">Skip to main content</a>
	</div>

	<header class="UT-header theme1">
		<div class="container container-logo-p2">
			<div class="row">
				<div class="column small-12">
					<div class="p2-logo">
						<a href="http://dellmed.utexas.edu" on-click="w3-close()" class="main-logo"><img src ="Dell_Medical_School_logo.png" alt="Home" /></a>
					</div>
				</div>
			</div>
			<a href="#" class="UT-nav-hamburger icon-menu" id="menu-icon"><span class="hiddenText">Menu</span></a>
		</div> <!-- container-logo -->

		<div class="nav-overlay" id="nav-overlay"></div>
			<div class="nav-wrapper" role="navigation">

				<div class="container container-topnav">
					<div class="row">
						<div class="column small-12">
							<div class="topnav">
								<div class="parent-banner-links">
								<a href="DMS_logout.php" style="position:relative;left:-20px;top:-12px;color:white;" onclick="w3_close()"><font size="2">Logout</font></a>
									<h2 class="UT-secondary-logo">
										<a href="http://www.utexas.edu" class="logo-link"><img src="Texas_logo.png" alt="UTexas Home" /><br></a>
									</h2>
								</div>

								<div class="hide-for-large-up">
									<div class="parent-links" id="parents">
										<a href="http://www.utexas.edu">The University of Texas at Austin</a>
									</div>

									<a href="/" class="current-directory" id="show-parents"><span class="name">Dell Medical School</span><span class="toggle"></span></a>
								</div>
								<br>
								<br>
								<br>
							</div>
						</div>
					</div>
        </div>
				</div>
      </div> <!-- container-topnav -->
</body>

			<!-- !PAGE CONTENT! -->
			<div class="center" style="position:relative; bottom:-175px; vertical-align:bottom;"><center>
          <p>Something went wrong on our end. Please press <a href= <?php echo $here; ?>>here</a> to navigate back to your dashboard.</p>
		  <br><br><br>
		  <small>If this link does not work, click the logout button in the upper righthand corner.</small>
        </center>
      </div>
	  
	  

