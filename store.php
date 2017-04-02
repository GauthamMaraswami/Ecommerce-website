<?php
	session_start(); 
	$pg_title = 'Store';
	// connect to database	
	$link = mysql_connect('localhost','root');
	mysql_select_db('project_2', $link);

	if (array_key_exists('loggedIn',$_SESSION)) {
		// get user's name
		$user_name = $_SESSION['name'];
	}

	$query = "SELECT * FROM store WHERE approval = 1 AND ";
		
	// particular college is selected
	if (isset($_GET['college']) && $_GET['college'] != '0'){
		// particular category is selected
		if (isset($_GET['category'])){
			$query = $query . " college = ".$_GET['college']." AND category = ".$_GET['category'];
		}
		// particular category is not selected
		else{
			$query = $query . " college = ".$_GET['college'];		
		}
	}
	// particular college is not selected
	else{
		if(isset($_GET['category'])){
			$query = $query . " category = ".$_GET['category'];
		}
		else{
			$query = $query . "1";
		}
	}
	$res = mysql_query($query);
	require("./views/header.php");
	require('./views/store_body.php');	
	require("./views/footer.php");
?>
