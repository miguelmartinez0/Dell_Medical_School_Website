<?php
//LOGOUT- ENDS SESSION AND REDIRECTS TO LOGIN PAGE
	require 'DMS_general_functions.php';
	session_start();
    $_SESSION = array();
    session_destroy();
	header("Location: DMS_login.php");
?>
