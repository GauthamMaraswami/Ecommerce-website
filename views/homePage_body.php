<div class="container">

	
	<ul >
        
                        <li><a href="./store.php">GO TO STORE</a>
                            </li>
						<li>	<a href="./postad.php">Sell Item</a></li>
                        <li><a href="./logout.php">LOG OUT</a></li>
						<li><span style="display:inline-block; width: 1020px;"></span></li>
						<li><p style="color:white">Logged in as, <?=$user_name?></p></li>
                        
</ul>
<p style="padding:30px;"></p>
	<div align="center">
		<span id="msg">
			<?php
				if(isset($admin_approval_msg)){
					echo($admin_approval_msg);
				}
				$res = mysql_query("SELECT * FROM store where seller_id =".$_SESSION['loggedIn']);
				$row = mysql_fetch_array($res);
				if($row === false) {
					echo("<h2>You haven't put any item on sale yet.</h2>");
					echo("</span>");
				}
				else {
					echo("</span>");
					echo("
						<form method='POST' action='./index.php'>
						<table style='border: 2px solid wheat;'>
						<tbody>
							<tr>
								<th>Image</th>	
								<th>Title</th>
								<th>Description</th>
								<th>Price</th>
								<th>Date</th>
								<th>Remove</th>
							</tr>
					");
					
					$res = mysql_query("SELECT * FROM store where seller_id =".$_SESSION['loggedIn']);
					while($row = mysql_fetch_array($res)) {
						$img_file = 'img/default.jpg';
						if ($row['image'] == 1){
							$img_file = 'img/'.$row['item_id'].'.jpg';
						}	
						echo("	<tr>
								<td>
									<img width='100px' height='50px' src='{$img_file}'>
								</td>
								<td>{$row['name']}</td>
								<td>{$row['description']}</td>
								<td>{$row['price']}</td>
								<td>{$row['date']}</td>
								<td><button name='delete' value='".$row['item_id']."'>Delete</button></td>	
							</tr>
						");
				}
			}
		?>
	</div>
</div>
