<?php
	session_start();
	session_unset();
	session_destroy();
	$logOut_msg = "You have Logged Out Successfully";	
	$pg_title = "Logout Successful";
	require("./views/header.php");
	require("./views/index_body.php");
	require("./views/footer.php");
?>
