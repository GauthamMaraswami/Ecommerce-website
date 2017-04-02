<div class="container">
<ul >
						      <li><a href="./index.php">HOME</a></li>
                        <li ><a href="./store.php">GO TO STORE</a></li>
                          
						 <li><a href="./logout.php">LOG OUT</a></li>
						 <li><span style="display:inline-block; width: 1020px;"></span></li>
						<li><p style="color:white">Logged in </p></li>
						
                        
                    </ul>
					<p style="padding:30px;"></p>
	<div align="center">
	<form name="postad" id="postF" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
		<select name="category" required>
			<option value="0" selected="" disabled="">Select Category</option>
			<!--
			<option value="1">Books</option>
			<option value="2">Clothing</option>
			<option value="3">Electronics</option>
			<option value="4">Furniture</option>
			<option value="5">Sports</option>
			<option value="6">Vehicle</option>
			<option value="7">Others</option>
			-->
			<?php
				// connect to database to see which all categories are listed
				$link = mysql_connect('localhost','root');
				mysql_select_db('project_2', $link);
					
				$res2 = mysql_query("SELECT * FROM categories");

				$row = mysql_fetch_array($res2);
				while($row != false){
					echo("<option value='".$row['category_id']."'>".$row['category_name']."</option>");
					$row = mysql_fetch_array($res2);
				}
			?>
		</select>
		<br>
		<div align="left">
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 500px;"></span>
		Enter Item Title:<span style="display:inline-block; width: 20px;"></span>
		<input type="text" name="title" required  placeholder="Item Title (Min. length 4 char)" size="50">
	
		<br>
		<p style="padding:0px;"></p>
				<span style="display:inline-block; width: 480px;"></span>
		Enter Item Description:<span style="display:inline-block; width: 20px;"></span>
		<textarea type="text" name="desc" required placeholder="Item description (Max. length 200 char)"width="100"></textarea>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 550px;"></span>
		Contact Info:<span style="display:inline-block; width: 20px;"></span>
		<textarea type="text" name="contact" placeholder="Contact info (Min. length 4 char)"></textarea>
		<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 550px;"></span>
		<input type="radio" name="choice" value="1">I want to Donate
		<input type="radio" name="choice" value="0">I want to Sell<br>
		<p style="padding:0px;"></p>
		<span style="display:inline-block; width: 620px;"></span>
		Price:<span style="display:inline-block; width: 10px;"></span>
		<input type="text" name="price" placeholder="Your Price (In Rs.)">
		<br>
		<p style="padding:0px;"></p>
		<input type="hidden" name="MAX_FILE_SIZE" value="30000000">
		<div class="upload-div"><span style="display:inline-block; width: 550px;"></span>Upload Image: <input class="upload-img" type="file" name="image">
		<br>
		<p style="padding:0px;"></p>
		</div>
		<p style="padding:0px;"></p><span style="display:inline-block; width: 700px;"></span>
		<button type="submit" form="postF">Submit</button>
	</form>
	</div>
	<ul id="msg" style="background:0000">
		<?php
			if(isset($error_in_form) && $error_in_form) {
				echo("<span style=\"display:inline-block; width: 100px;\"></span><li align=\"center\"style=\"background:0000\">Please provide required and valid data.</li>
				");
			}
			if(isset($error_in_file) && $error_in_file != ''){
				echo('<span style=\"display:inline-block; width: 30px;\"></span><li style=\"background:0000\">'.$error_in_file.'</li>');
			}
		?>	
	</ul>
</div>
</div>