<?php
	$pg_title = 'Dashboard';
	
	//connect to database
	$link = mysql_connect('localhost','root');
	mysql_select_db('project_2', $link);

	$res = mysql_query("SELECT * FROM store where item_id =".$_GET['item']);
	$row = mysql_fetch_array($res);
	$contact_det = $row['contact'];
	require('./views/header.php');
	require('./views/item_body.php');
	require('./views/footer.php');
?>
