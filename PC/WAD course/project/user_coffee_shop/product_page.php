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
    <link rel="stylesheet" href="./styles/product_page.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
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
        <a href="http://localhost/project/user_coffee_shop/user_cart.php"  class="cart_bg">
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
        <div class="row1_col1">
            <img src="<?php echo $_GET['pimage']?>" alt="masala tea">
        </div>
        <div class="row1_col2">
            <div class="row1_col2_row1">
                <p><?php echo $_GET['pname']?></p>
            </div>
            <div class="row1_col2_row2">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci error voluptate quisquam, ab est obcaecati! Reprehenderit impedit, ratione culpa dolore perspiciatis dolorum, dolores cum deserunt nulla repellat quos, accusamus voluptatibus.</p>
            </div>
            <div class="row1_col2_row3">
                <P>Rs.<?php echo $_GET['pprice']?></P>
            </div>
            <div class="row1_col2_row4">
                <div class="quantity_container">
                    <button class="sub" onclick="quantity_reduce('quantity_value_id')">-</button>
                    <div class="quantity_value" id="quantity_value_id">0</div>
                    <button class="add" onclick="quantity_add('quantity_value_id')">+</button>
                </div>
            </div>
            <div class="row1_col2_row5">
                <a class="buy_now_btn" id="buy_now_id">Order Now</a>
                <button class="add_to_cart_btn" id="add_to_cart_id" onclick = "add_to_cart('<?php echo $_GET['table']?>','<?php echo $_GET['pid']?>','<?php echo $_GET['pname']?>','<?php echo $_GET['pprice']?>','<?php echo $_GET['pcategory']?>','quantity_value_id','<?php echo $_GET['pimage']?>')">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
<div id="when_carted">
    <div class="when_carted_circle"></div>
    <div class="when_carted_rectangle"></div>
    <p class="when_carted_text">Added to Cart</p>
</div>
</body>
<script type="text/javascript">
const isHidden = elem => {
    const styles = window.getComputedStyle(elem)
    return styles.display === 'none' || styles.visibility === 'hidden'
}

function show(target) {
    document.getElementById(target).style.visibility = 'visible';
}

function hide(target) {
    document.getElementById(target).style.visibility = 'hidden';
}

function show_and_hide(target) {
    const elem = document.getElementById(target);
    if (isHidden(elem)) {
        show(target);
    } else {
        hide(target);
    }
}
function quantity_add(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    quantity += 1;

    document.getElementById(quantity_id).innerHTML = String(quantity);
    if(quantity == 0){
        document.getElementById("buy_now_id").style.visibility = "hidden";
        document.getElementById("add_to_cart_id").style.visibility = "hidden";
    }
    else{
        document.getElementById("buy_now_id").style.visibility = "visible";
        document.getElementById("add_to_cart_id").style.visibility = "visible";
    }
}

function quantity_reduce(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    if (quantity > 0) {
        quantity -= 1;
    }
    document.getElementById(quantity_id).innerHTML = String(quantity);
    if(quantity == 0){
        document.getElementById("buy_now_id").style.visibility = "hidden";
        document.getElementById("add_to_cart_id").style.visibility = "hidden";
    }
    else{
        document.getElementById("buy_now_id").style.visibility = "visible";
        document.getElementById("add_to_cart_id").style.visibility = "visible";
    }
}

function add_to_cart(table,pid,pname,pprice,pcategory,quantity_id,pimage){
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    var ajax1 = new XMLHttpRequest();
    ajax1.open("GET", "http://localhost/project/user_coffee_shop/add_to_cart_data.php?table="+table+"&pid="+pid+"&pname="+pname+"&pprice="+pprice+"&pcategory="+pcategory+"&pquantity="+quantity+"&pimage="+pimage, true);
    ajax1.send();
    ajax1.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            const when_carted = document.getElementById("when_carted");
            when_carted.style.display = "flex";
            setTimeout(() => {
                when_carted.style.display = "none";
            }, 2000);
            document.getElementById("cart_value_id").innerHTML = String(data['N_rows']);

        }
    }
    
}
if(parseInt(document.getElementById('quantity_value_id').innerHTML) == 0){
    document.getElementById("buy_now_id").style.visibility = "hidden";
    document.getElementById("add_to_cart_id").style.visibility = "hidden";
}

</script>
</html>


