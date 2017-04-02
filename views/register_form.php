<div class="container">
<ul >
        
                        <li ><a href="./store.php">GO TO STORE</a></li>
                            
                       
                        
                       
                        
						<li>	<a href="./register.php">REGISTER</a></li>
                        <li><a href="./login.php">SIGN IN</a></li>
                        
</ul>
<p style="padding:30px;"></p>

		<h1 align="center">Register</h1>
<div align="left">

	<form id="RegisterF" method="POST" action="./register.php" onsubmit="return passwdmatch()">
	
	<span style="display:inline-block; width: 600px;"></span>
	E-mail address: <input type="email" name="email" required
				<?php
					if (!empty($_POST)) {
						echo(" value='{$_POST['email']}'");
					}
				?>
			>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 625px;"></span>
		First Name: <input type="text" name="name" required
				<?php
					if (!empty($_POST)) {
						echo(" value='{$_POST['name']}'");
					}
				?>
			>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 550px;"></span>
		College: <select name="cid" required>
				<option value="0" selected="" disabled="" >Select College</option>
				<option value="0">All</option>
				<!--
				<option value="31">Indian Institute of Technology, Delhi</option>
				<option value="33">Indian Institute of Technology, Guwahati</option>
				<option value="12">Birla Institute of Technology and Science, Pilani</option>
				<option value="78">National Institute of Technology, Jaipur</option>
				<option value="18">Delhi Technological University, New Delhi</option>
				-->
				<?php
					// connect to database to see which all colleges are listed
					$link = mysql_connect('localhost','root');
					mysql_select_db('project_2', $link);
					
					$res = mysql_query("SELECT * FROM colleges");

					$row = mysql_fetch_array($res);
					while($row != false){
						echo("<option value='".$row['college_id']."'>".$row['college_name']."</option>");
						$row = mysql_fetch_array($res);
					}
				?>
			</select>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 635px;"></span>
		Password: <input type="password" name="pwd" required id="pwd"
				<?php
					if (!empty($_POST)) {
						echo(" value='{$_POST['pwd']}'");
					}
				?>
			>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 585px;"></span>
		Retype Password: <input type="password" name="rpwd" id="rpwd" "
				<?php
					if (!empty($_POST)) {
						echo(" value='{$_POST['rpwd']}'");
					}
				?>
				>
		<br>
				<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 650px;"></span>
		Gender:<input type="radio" name="sex" value="0">M <input type="radio" name="sex" value="1">F
		<br>
		<p style="padding:0px;"></p>
	</form>
			<p style="padding:0px;"></p>
				<span style="display:inline-block; width: 670px;"></span>
<button type="submit" form="RegisterF" name="submit">Register</button>
<ul id="msg">
	<?=$error_message?>
</ul>
</div>