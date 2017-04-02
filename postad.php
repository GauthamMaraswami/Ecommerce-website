<?php
	session_start();
	$pg_title = 'PostAd';	
	if (array_key_exists('loggedIn',$_SESSION)) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$error_in_form = false;
			if(array_key_exists('category', $_POST)) {
				if($_POST['category'] == '0') {
					$error_in_form = true;
				}
			}
			else {
				$error_in_form = true;
			}
			
			if(strlen(trim($_POST['title'])) < 4) {
				$error_in_form = true;
			}
			if(strlen($_POST['desc']) > 200) {
				$error_in_form = true;
			}			
			if(strlen($_POST['contact']) < 4) {
				$error_in_form = true;
			}
			if(!array_key_exists('choice',$_POST)) {
				$error_in_form = true;	
			}
			else {
				if($_POST['choice'] == '0') {
					// check if price is a positive integer number if item is to be sold.
					preg_match('/\d+/', $_POST['price'], $matches);
					if (!empty($matches)) {
						if ($matches[0] != $_POST['price']) {
							$error_in_form = true;
						}
					}
					else {
						$error_in_form = true;
					}
				}
			}
			
			if(isset($error_in_form) && $error_in_form) {
				require("./views/header.php");
				require("./views/postad_form.php");
				require("./views/footer.php");
			}
			else {
				$admin_approval_msg = "Your item has been posted successfully but
					       	awaits Admin's approval to be displayed in our store";

				// connect to database	
				$link = mysql_connect('localhost','root');
				mysql_select_db('project_2', $link);

				// today's date
				$today = mysql_real_escape_string(date("F j, Y"));
				
				// get user's name
				$res = mysql_query("SELECT id, name FROM users 
					WHERE id=".$_SESSION['loggedIn']);
				$row = mysql_fetch_array($res);
				$user_name = $row['name'];
				
				// make price = 0 if item is to be donated
				if ($_POST['choice']) {
					$_POST['price'] = 0;
				}
				// upload file if valid file is sent
				if ($_FILES['image']['size'] > 0){
					$error_in_file = '';
					// check file format
					if($_FILES['image']['type'] != 'image/jpeg'){
						$error_in_file = 'Unsupported image extension. Please upload jpeg/jpg files only.';
						require("./views/header.php");
						require("./views/postad_form.php");
						require("./views/footer.php");
					}
					// check file size
					else if($_FILES['image']['size'] > 30000000){
						$error_in_file = 'Image Uploaded is too large.';
						require("./views/header.php");
						require("./views/postad_form.php");
						require("./views/footer.php");
					}

					// move uploaded file to img directory if it is valid 
					else {
						$query = "INSERT INTO store(seller_id, college, name, category, 
						       			description, contact, donate, price, date, image)
							VALUES(".mysql_real_escape_string($_SESSION['loggedIn']).",
								".mysql_real_escape_string($_SESSION['college']).",
								'".mysql_real_escape_string($_POST['title'])."',
								".mysql_real_escape_string($_POST['category']).",
								'".mysql_real_escape_string($_POST['desc'])."',
								'".mysql_real_escape_string($_POST['contact'])."',
								".mysql_real_escape_string($_POST['choice']).",
								".mysql_real_escape_string($_POST['price']).",'".
								$today.
								"',1)";
						mysql_query($query);

						// saving the uploaded file by the item_id of the item last submitted by user
						$query = "SELECT item_id FROM store WHERE seller_id = {$_SESSION['loggedIn']}";
						$res = mysql_query($query);
						$row = mysql_fetch_array($res);
						$fName = '';
						while ($row != false){
							$fName = $row['item_id'];
							$row = mysql_fetch_array($res);
						}
						$permanent_file = './img/'.$fName.'.jpg';
						move_uploaded_file($_FILES['image']['tmp_name'], $permanent_file);
						require("./views/header.php");
						require('./views/homePage_body.php');
						require("./views/footer.php");
					}
				}
				else{
					// insert row in sql with image = 0
					$query = "INSERT INTO store(seller_id, college, name, category, contact,
					       			description, donate, price, date, image)
							VALUES(".mysql_real_escape_string($_SESSION['loggedIn']).",
								".mysql_real_escape_string($_SESSION['college']).",
								'".mysql_real_escape_string($_POST['title'])."',
								".mysql_real_escape_string($_POST['category']).",
								'".mysql_real_escape_string($_POST['contact'])."',
								'".mysql_real_escape_string($_POST['desc'])."',
								".mysql_real_escape_string($_POST['choice']).",
								".mysql_real_escape_string($_POST['price']).",'".
								$today.
								"',0)";
					mysql_query($query);
					require("./views/header.php");
					require('./views/homePage_body.php');
					require("./views/footer.php");
				}
			}
		}
		// if request method is GET (form is not submitted)
		else {
			require("./views/header.php");
			require("./views/postad_form.php");
			require("./views/header.php");
		}
	}

	// show login form if user is not signed in
	else {
		require("./views/header.php");
		require("./views/login_form.php");
		require("./views/footer.php");
	}
?>
