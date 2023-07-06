<?php
session_start();
if(!isset($_SESSION['coffee_shop_user_id']))
{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <!-- <script src="./script.js"></script> -->
    <title>Coffee Shop</title>
</head>

<body>
    <div class="navbar_bg">
        <div class="navbar">
            <div class="logo_bg">
                <img src="./images/logo.png" alt="logo" id="logo">
                <a href="http://localhost/project/user_coffee_shop/home.php" class="logo_clickable"></a>
            </div>
            <div class="navbtns">
                <a href="http://localhost/project/user_coffee_shop/home.php" class="navbtn">Home</a>
                <a href="http://localhost/project/user_coffee_shop/home.php" class="navbtn">About</a>
            </div>
            <a href="http://localhost/project/user_coffee_shop/user_cart.php" class="cart_bg">
                <img src="./images/cart.png" alt="cart" id="cart">
                <p class="cart_value" id="cart_value_id">
                    <?php
                    $conn = new mysqli("localhost","root","","project");
                    $q = "SELECT COUNT(*) as `N_rows` FROM ".$_SESSION['coffee_shop_user_id']."_cart_info";
                    $ds=$conn->query($q);
                    $row = $ds->fetch_assoc();
                    if($row){
                        echo $row['N_rows'];
                    }
                    ?>
                </p>
            </a>
            <div class="useracc_bg">
                <img src="./images/useracc.png" alt="user acc" id="useracc_icon" onclick="show_and_hide('drop_content')">
                
                <div id="drop_content">
                    <a href="http://localhost/project/user_coffee_shop/logout.php" class="drop_content_btn">
                        <p>
                            Log out
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row1">
        <div class="container">
            <h1>Select your table</h1>
        </div>
    </div>
    <div class="row2">
        <div class="container">
            <div id="tables">
                <a href="http://localhost/project/user_coffee_shop/table.php?table=1" . class="table">
                    <img src="./images/table.png" alt="table1">
                    <h1>1</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=2" class="table">
                    <img src="./images/table.png" alt="table2">
                    <h1>2</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=3" class="table">
                    <img src="./images/table.png" alt="table3">
                    <h1>3</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=4" class="table">
                    <img src="./images/table.png" alt="table4">
                    <h1>4</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=5" class="table">
                <img src="./images/table.png" alt="table5">
                    <h1>5</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=6" class="table">
                    <img src="./images/table.png" alt="table6">
                    <h1>6</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=7" class="table">
                    <img src="./images/table.png" alt="table7">
                    <h1>7</h1>
                </a>
                <a href="http://localhost/project/user_coffee_shop/table.php?table=8" class="table">
                    <img src="./images/table.png" alt="table8">
                    <h1>8</h1>
                </a>
            </div>
        </div>
    </div>
</body>

</html>


