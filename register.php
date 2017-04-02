<?php 
	session_start();
	$pg_title = 'Register';
	$error_message = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		/* check the validity of all the entries
		 * if any entry is wrong then display error message along with the registration form
		 */

		// regex for email : /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST['email'], $matches);	

		if (empty($matches)) {
			$error_message = $error_message . "<li>Invalid Email</li>";
		} 
		else if ($matches[0] != $_POST['email']) {
			// email is invalid
			$error_message = $error_message . "<li>Invalid Email</li>";
		}
		

		// regex for name: /^[A-Za-z ]{2,30}$/
		preg_match('/^[A-Za-z ]{2,30}$/', $_POST['name'], $matches);
		if (empty($matches)) {
			$error_message = $error_message . "<li>Invalid Name</li>";
		} 
		else if ($matches[0] != $_POST['name']) {
			// email is invalid
			$error_message = $error_message . "<li>Invalid Name</li>";
		}
			
		// college id should not be equal to 0
		if (empty($_POST['cid'])) {
			$error_message = $error_message . "<li>No College selected</li>";
		}
		else if ($_POST['cid'] == '0') {
			$error_message = $error_message . "<li>No College selected</li>";
		}

		// password should be 6 to 30
		if (strlen($_POST['pwd']) > 30 || strlen($_POST['pwd']) < 6 ) {
			$error_message = $error_message . "<li>Password must contain 6 to 30 characters</li>";
		}

		// re-typed password must match
		if ($_POST['pwd'] != $_POST['rpwd']) {
			$error_message = $error_message . "<li>Passwords don't match</li>";
		}
		if (!array_key_exists('sex',$_POST)) {
			$error_message = $error_message . "<li>No Gender selected</li>";
		}

		/* if all the entries are correct then add a row in the database table that contains 
		 * the email and password of the users 
		 * and login the user
		 * and open dashboard
		 */
		
		if ($error_message == "") {
			// update user's table and login the user and redirect to dashboard
			$link = mysql_connect('localhost','root');
			mysql_select_db('project_2', $link);
			$query = "INSERT INTO users(email, password, name, college_id, gender, no_of_items) 
				VALUES('".mysql_real_escape_string($_POST['email'])."'
				,'".crypt($_POST['pwd'],'CRYPT_BLOWFISH')."'
				,'".mysql_real_escape_string($_POST['name'])."',
				".mysql_real_escape_string($_POST['cid']).",".$_POST['sex'].",0)";
			
			mysql_query($query);
			preg_match('/duplicate/i', mysql_error(), $matches);
			if (!empty($matches)) {
				$error_message = $error_message . "<li>User with this email already exists</li>";
				
				require("./views/header.php");
				require("./views/register_form.php");
				require("./views/footer.php");
			}
			else {
				// login the user
				$res = mysql_query("
						SELECT * FROM users 
						WHERE email = '".mysql_real_escape_string($_POST['email'])."'
						AND password = '".crypt($_POST['pwd'],'CRYPT_BLOWFISH')."'
					");
				$row = mysql_fetch_array($res);
				$_SESSION['loggedIn'] = $row['id'];		
				$_SESSION['name'] = $row['name'];
				$_SESSION['college'] = $row['college_id'];

				// redirect to index page
				header('Location: index.php');
			}
		}
		else {
			require("./views/header.php");
			require("./views/register_form.php");
			require("./views/footer.php");
		}
	}
	else {
		// display registration form
		require("./views/header.php");
		require("./views/register_form.php");
		require("./views/footer.php");
	}
?>
