<?php
	session_start();
	if (array_key_exists('loggedIn',$_SESSION)) {
		$link = mysql_connect('localhost','root');
		mysql_select_db('project_2', $link);
		$res = mysql_query("SELECT id, name FROM users 
				WHERE id=".$_SESSION['loggedIn']);
		$row = mysql_fetch_array($res);
		$user_name = $row['name'];
		if(array_key_exists('delete', $_POST)) {
			mysql_query("DELETE FROM store WHERE item_id={$_POST['delete']}");
		}
		$pg_title = 'Dashboard';
		require("./views/header.php");
		require("./views/homePage_body.php");
		require("./views/footer.php");
	}
	else {
		$pg_title = 'Project 2';
		require("./views/header.php");
		require("./views/index_body.php");
		require("./views/footer.php");
	}
?>
