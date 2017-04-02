<ul >
        
                        <li class="dropdown"><a href="./store.php">GO TO STORE</a>
                         </li>
                       
                        
                       
                        
						<li>	<a href="./register.php">REGISTER</a></li>
                        <li><a href="./login.php">SIGN IN</a></li>
                        
</ul>
<p style="padding:30px;"></p>
<div class="container" >
<div align="center">
<h1>Login</h1>
	<form id="LoginF" method="POST" action="./login.php"onsubmit="return passwdcheck()" >
		E-mail address: <input type="email" name="email" required>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 30px;"></span>
		Password: <input type="password" name="password" id="passwd123">
		<br>
		
		<span id="msg"></span>
	</form>
	<span style="display:inline-block; width: 30px;"></span>
	<button form="LoginF" type="submit">Log In</button>
	<span>or, <a href="./register.php">Register</a></span>
	</div>
</div>
