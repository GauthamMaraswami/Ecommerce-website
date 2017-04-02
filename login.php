<?php
	session_start();
	$logIn_err_msg = '';
	$pg_title = 'Login';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		/* check the entries in database and sign in the user
		 * if it matches
		 * else display wrong password or username message
		 */
		$link = mysql_connect('localhost','root');
		mysql_select_db('project_2', $link);
		$res = mysql_query("
				SELECT id, name, college_id FROM users 
				WHERE email = '".mysql_real_escape_string($_POST['email'])."'
				AND password = '".crypt($_POST['password'],'CRYPT_BLOWFISH')."'
				");
		
		$row = mysql_fetch_array($res);
		if ($row === false) {
			$logIn_err_msg = 'Wrong email or password';
			
			require("./views/header.php");
			require("./views/login_form.php");
			require("./views/footer.php");
		}
		else {
			$_SESSION['loggedIn'] = $row['id'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['college'] = $row['college_id'];
			header('Location:./index.php');
		}
	}
	else {
		require("./views/header.php");
		require("./views/login_form.php");
		require("./views/footer.php");
	}	
?>
