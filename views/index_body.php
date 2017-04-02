

<ul >
        
                        <li class="dropdown"><a href="./store.php">GO TO STORE</a>
                           </li>
                       
                        
                       
                        
                   
                        <li><a href="./login.php">SIGN IN</a></li>
                        
                    </ul>
					<p style="padding:30"></p>
					<div align="center">
					<img src="img/default.jpg" alt="cat"  >
					</div>
<?php
	if(isset($logOut_msg)){
			echo("<span style=\"display:inline-block; width: 400px;\"></span>");
		echo("<h2 align=\"center\"><span id='msg'>".$logOut_msg."</span></h2>");
	
		echo("<br>");
	}
?>