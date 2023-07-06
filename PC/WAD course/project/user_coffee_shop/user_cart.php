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
    <link rel="stylesheet" href="./styles/user_cart.css">
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
            <h1>Users cart</h1>
        </div>
    </div>
    <div class="row2">
        <?php 
        if($row['N_rows']==0){
        ?>
        <div class="zero_cart">
            0 products in the cart
        </div>
        <?php
        }
        else{
        ?>
        
        <div class="container_block">
            <?php
            $conn = new mysqli("localhost","root","","project");
            $q = "SELECT distinct(dining_table) from ".$_SESSION['coffee_shop_user_id']."_cart_info";
            $ds = $conn->query($q);

            while($row=$ds->fetch_assoc()){
                $dining_table_no = $row['dining_table'];
            ?>
            <table id = "cart_product_list">
                <tr>
                    <td class="table_no">
                        <?php echo "Table # ".$dining_table_no?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="order_now">
                            Order Now
                    </td>
                </tr>
                <?php
                $q2 = "SELECT distinct(pcategory) from ".$_SESSION['coffee_shop_user_id']."_cart_info where dining_table=$dining_table_no";
                $ds2 = $conn->query($q2);
                while($row2=$ds2->fetch_assoc()){
                    $category = $row2['pcategory'];
                ?>
                <tr>
                    <td></td>
                    <td class="category_name_bg">
                        <p>
                            <?php echo $category?>
                        </p>
                    </td>
                    <td></td>
                </tr>
                <?php
                $q3 = "SELECT * from ".$_SESSION['coffee_shop_user_id']."_cart_info where pcategory='$category' AND dining_table=$dining_table_no";
                // echo "<script>alert($q3)</script>";
                $ds3 = $conn->query($q3);
                while($row3=$ds3->fetch_assoc()){
                    $pid = $row3['pid'];
                    $pname = $row3['pname'];
                    $pprice = $row3['pprice'];
                    $pquantity = $row3['pquantity'];
                    $pimage = $row3['pimage'];
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="pinfo_grid">
                        <input type="checkbox" class="checkbox" id="checkbox_<?php echo $pid?>">
                        <img class="pimage" src="<?php echo $pimage?>" alt="" srcset="">
                        <p class="pname"><?php echo $pname?></p>
                        <p class="pprice"><?php echo $pprice?></p>
                        <div class="quantity_cell">
                            <button class="add" id="add_<?php echo $pid?>" onclick = "quantity_change_directly_in_db_table('<?php echo $pid?>','quantity_<?php echo $pid?>','add_<?php echo $pid?>')">
                                <p>
                                    +
                                </p>
                            </button>
                            <label class ="quantity" id="quantity_<?php echo $pid?>">
                                <?php echo $pquantity?>
                            </label>
                            <button class="sub" id="sub_<?php echo $pid?>" onclick = "quantity_change_directly_in_db_table('<?php echo $pid?>','quantity_<?php echo $pid?>','sub_<?php echo $pid?>')">
                                <p>
                                    -
                                </p>
                            </button>
                        </div>
                        <button class="delete_btn" onclick = "delete_product('<?php echo $pid?>')">
                            Delete
                        </button>
                    </td>
                </tr>
                <br>
                <?php
                }
                ?>
                <?php
                }
                ?>
            </table>
            <?php
            }
            ?>
        </div>
        <?php
        }
        ?>
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

function quantity_change_directly_in_db_table(target_pid,pquantity_id,add_or_sub_btn_id){


    var pquantity = parseInt(document.getElementById(pquantity_id).innerHTML);
    if(add_or_sub_btn_id=="add_"+target_pid)
    {
        pquantity+=1;
    }
    else if(add_or_sub_btn_id=="sub_"+target_pid)
    {
        if (pquantity > 0) {
            pquantity -= 1;
        }
    }
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "http://localhost/project/user_coffee_shop/quantity_change_directly_in_table.php?pid="+target_pid+"&pquantity="+pquantity, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            if(data[0]=="quantity_changed"){
                document.getElementById(pquantity_id).innerHTML = String(pquantity);
            }
        }
    }
}
function delete_product(target_pid) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "http://localhost/project/user_coffee_shop/delete_product.php?pid="+target_pid, true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            if(data[0]=="product_deleted"){
                window.location.replace('user_cart.php')
            }
        }
    }
    
}


</script>
</html>


