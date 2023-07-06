<!DOCTYPE html>
<html>
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
				<h1>Update product record</h1>
			</div>
			<div class="container1_row2">
				<?php
				$conn = new mysqli("localhost", "root", "", "project");
				$q = "select * from product_table where id =" . $_GET['id'];
				$ds = $conn->query($q);
				$row = $ds->fetch_assoc();
				$action = "updateData.php?id=" . $_GET['id'];
				?>
				<form method="POST" action="<?php echo $action ?>" id = "form1">
					<table id = "data_entery_table">
						<tr>
							<th>Product name</th>
							<th>Price</th>
							<th>Category</th>
						</tr>
						<tr>
							<td>
								<input type="text" name="pname" value="<?php echo $row['pname']; ?>">
							</td>
							<td>
								<input type="text" name="pprice" value="<?php echo $row['pprice']; ?>">
							</td>
							<td>	
								<input type="text" name="pcategory" value="<?php echo $row['pcategory']; ?>">
							</td>
						</tr>
					</table>	
					<input type="submit" id = "submitbtn" value="Update">
				</form>
			</div>
        </div>
    </div>
</body>

</html>

