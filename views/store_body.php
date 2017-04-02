<div class="container">
	<?php 
		if(isset($user_name)){
			echo("<li style=\"color:white\">Logged in as<a href='./index.php'>".$user_name."</a></li>
				<li><a href='./postad.php'>Sell Item</a></li>
				
				<li><a href='./logout.php'>Logout</a></li>
				");		
		}
		else{
			echo("
			<li><a href='./index.php'>Home</a>
			<li><a href='./postad.php'>Sell Item</a>
			<span style=\"display:inline-block; width: 100px;\"></span></li>");
		}
		$select_college = '';
		// check if any college is selected
		if (isset($_GET['college']) && $_GET['college'] != 0){
			$select_college = 'college='.$_GET['college'].'&';
		}
		$category_target = "./store.php?".$select_college."category=";
	?>

	<ul>
			<li><span style="display:inline-block; width: 400px;"></span></li>
		<li><a href="./store.php?<?=$select_college?>">All</a></li>
		<!--
		<li><a href="<?=$category_target?>1">Books</a></li>
		<li><a href="<?=$category_target?>2">Clothing</a></li>
		<li><a href="<?=$category_target?>3">Electronics</a></li>
		<li><a href="<?=$category_target?>4">Furniture</a></li>
		<li><a href="<?=$category_target?>5">Sports</a></li>
		<li><a href="<?=$category_target?>6">Vehicle</a></li>
		<li><a href="<?=$category_target?>7">Others</a></li>
		-->
	
		<?php
			// connect to database to see which all categories are listed
			$link = mysql_connect('localhost','root');
			mysql_select_db('project_2', $link);
				
			$res2 = mysql_query("SELECT * FROM categories");

			$row2 = mysql_fetch_array($res2);
			while($row2 != false){
				echo("<li><a href='".$category_target.$row2['category_id']."'>".$row2['category_name']."</a></li>");
				$row2 = mysql_fetch_array($res2);
			}
		?>
	</ul>
	<p style="padding:30px;"></p><p>
	<div align="center">
	<div>
		<form>
			<select name="college">
				
				<option value="0" selected="" disabled="" required>Select College</option>
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
					mysql_select_db('Project_2', $link);
					
					$res2 = mysql_query("SELECT * FROM colleges");

					$row2 = mysql_fetch_array($res2);
					while($row2 != false){
						echo("<option value='".$row2['college_id']."'>".$row2['college_name']."</option>");
						$row2 = mysql_fetch_array($res2);
					}
				?>
			</select>
			<button type="submit" style="background-color: #000000; color: white;">Search</button></div>
		</form>
		<br>
				<?php 
					if ($res == false){
						$row = false;
					}
					else{
						$row = mysql_fetch_array($res);
					}
					if ($row == false){
						$no_item_msg = 'No items yet. :(';
						echo("<span id='msg'>".$no_item_msg."</span>
							<br>
						");
					}
					else{
						echo("<div align=\"center\">
							<br>
							<table style='border: 2px solid wheat;'>
							<tbody>
							<tr>
							<th>Image</th>
							<th>Title</th>
							<th>Price</th>
							<th>College</th>
							<th>Category</th>
							<th>Date</th>
							<th>Contact Seller</th>
							</tr>
							<tr>
						");	
						while($row != false){
							if ($row['image'] == 1){
								$fName = './img/'.$row['item_id'].'.jpg';
							}
							else{
								$fName = './img/default.jpg';
							}
							
							// get college name
							$res2 = mysql_query("SELECT college_name FROM colleges 
								WHERE college_id =".$row['college']);
							$row2 = mysql_fetch_array($res2);
							$college_name = $row2['college_name'];

							// get category name
							$res2 = mysql_query("SELECT category_name FROM categories
								WHERE category_id =".$row['category']);
							$row2 = mysql_fetch_array($res2);
							$category_name = $row2['category_name'];

							echo("	<tr><td>
									<img width = '100px' height='50px' 
									src='".$fName."'>
								</td>");

							echo("<td>"."<span style=\"display:inline-block; width: 10px;\"></span>".$row['name']."</td>");
							echo("<td>"."<span style=\"display:inline-block; width: 10px;\"></span>".$row['price']."</td>");
							echo("<td>"."<span style=\"display:inline-block; width: 50px;\"></span>".$college_name."</td>");
							echo("<td>"."<span style=\"display:inline-block; width: 50px;\"></span>".$category_name."</td>");
							echo("<td>"."<span style=\"display:inline-block; width: 50px;\"></span>".$row['date']."</td>");
							echo("<td><span style=\"display:inline-block; width: 50px;\"></span><a href='./item.php?item=".$row['item_id']."'>Contact Seller</a></td></tr>");
							$row = mysql_fetch_array($res);
						}	
						echo("
							</tr>
							</tbody>
							</table>
							</div>
						");	
					}
				?>	
	</div>   
</div>
