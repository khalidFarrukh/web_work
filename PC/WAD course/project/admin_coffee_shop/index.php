<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
	<link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Administrator</title>
</head>

<body>
    <div class="navbar_bg">
        <div class="navbar">
            <div class="logo_bg">
                <img src="./images/logo.png" alt="logo" id="logo">
                <a href="http://localhost/project/admin_coffee_shop/index.php" class="logo_clickable"></a>
            </div>
            <div class="navbtns">
                <a href="http://localhost/project/admin_coffee_shop/index.php" class="navbtn">Home</a>
            </div>
        </div>
    </div>
    <div class="container1_bg">
        <div class="container1">
			<div class="container1_row1">
				<h1>Enter new product record</h1>
			</div>
			<div class="container1_row2">
				<form method="POST" action="insertData.php" id = "form1">
					<table id = "data_entery_table">
						<tr>
							<th>Product name</th>
							<th>Price</th>
							<th>Category</th>
						</tr>
						<tr>
							<td>
								<input type="text" name="pname" required>
							</td>
							<td>
								<input type="text" name="pprice" required>
							</td>
							<td>	
								<input type="text" name="pcategory" required>
							</td>
						</tr>
					</table>	
					<input type="submit" id = "submitbtn">
				</form>
			</div>
        </div>
    </div>
	<div class="container2_bg">
		<div class="container2">
			<div class="container2_row1">
				<h1>Product list</h1>
			</div>
			<div class="container2_row2">
				<?php
				$conn = new mysqli("localhost","root","","project");
				$q= "select * from product_table";
				$ds = $conn->query($q);
				$ds1 = $conn->query($q);
				echo '<table id = "product_table_output">';
				echo "<tr>";
				echo "<th>ID</th>";
				echo "<th>Product name</th>";
				echo "<th>Price</th>";
				echo "<th>Category</th>";
				echo "</tr>";
				$index = 1;
				$row1=$ds1->fetch_assoc();
				if($row1==true){
					while($row=$ds->fetch_assoc()){
						echo"<tr>";
						echo"<td>".$index++."</td>";
						echo"<td>".$row["pname"]."</td>";
						echo"<td>".$row["pprice"]."</td>";
						echo"<td>".$row["pcategory"]."</td>";
						echo"<td class='delete_cell'>
						<div id='delete_btn_bg'>
							<a id='delete_btn_clickable' href='delete.php?id=".$row["id"]."'></a>
							<p id='delete_btn_text'>Delete</p>
						</div>
						</td>";
						echo"<td class='update_cell'>
						<div id='update_btn_bg'>
						<a id='update_btn_clickable' href='update.php?id=".$row["id"]."'>
						</a>
						<p id='update_btn_text' >
						Update
						</p>
						</div>
						</td>";
						echo"</tr>";
					}
				}
				if($row1==false){
					echo"<tr>";
					echo"<td>".$index++."</td>";
					echo"<td>NILL</td>";
					echo"<td>NILL</td>";
					echo"<td>NILL</td>";
					echo"</tr>";
				}
				
				echo "</table>";
				?>
			</div>
		</div>
	</div>
</body>

</html>
