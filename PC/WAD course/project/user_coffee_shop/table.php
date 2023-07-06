<?php
session_start();
if(!isset($_SESSION['coffee_shop_user_id']))
{
	header("Location:login.php");
}
$table_no = $_GET['table'];
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
    <link rel="stylesheet" href="./styles/table.css">
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
            <h1>Select what you want to have</h1>
        </div>
    </div>
     <div class="row2">
        <div class="container">
            <div class="category">
                <?php
                $conn = new mysqli("localhost","root","","project");
                $q = "SELECT distinct(pcategory) from `product_table`";
                $ds = $conn->query($q);
                ?>
                <?php
                $category_index=0;
                while($row=$ds->fetch_assoc()){
                    $under_scored_pcategory = "category_".$category_index++;
                    $pcategory_size = strlen($row['pcategory']);
                ?>
                <div class="category_btn" id="<?php echo $under_scored_pcategory ?>" onclick="show_product_list('<?php echo $under_scored_pcategory ?>_product_list','<?php echo $under_scored_pcategory ?>')">
                    <p>
                        <?php echo $row['pcategory'] ?>
                    </p>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row3">
        <div class="container">
            <div id = "products"></div>
        </div>
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
const element = document.getElementById("products");
var currently_selected_category = "category_0";

function show_product_list(target, self) {
    var ajax1 = new XMLHttpRequest();
    ajax1.open("GET", "distinct_categories.php", true);
    ajax1.send();
    ajax1.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data1 = JSON.parse(this.responseText);
            for (var i = 0; i < data1.length; i++) {
                var under_scored_pcategory = "category_" + String(i);
                var under_scored_pcategory_product_list = under_scored_pcategory + "_product_list";
                if (self == under_scored_pcategory && target == under_scored_pcategory_product_list) {
                    document.getElementById(under_scored_pcategory).style.backgroundColor = 'rgb(255, 156, 43)';
                    // show(under_scored_pcategory_product_list);
                    currently_selected_category = under_scored_pcategory;
                    console.log(currently_selected_category);
                    if (currently_selected_category == under_scored_pcategory) {
                        console.log("hello");
                        var ajax2 = new XMLHttpRequest();
                        ajax2.open("GET", "product_list.php?category=" + data1[i]['pcategory'], true);
                        ajax2.send();
                        ajax2.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                var data2 = JSON.parse(this.responseText);
                                console.log(data2);
                                element.innerHTML = '';
                                for (var j = 0; j < data2.length; j++) {
                                    const a_tag = document.createElement("a");
                                    a_tag.href = "http://localhost/project/user_coffee_shop/product_page.php?table=<?php echo $table_no?>&pid="+data2[j]['id']+"&pname="+data2[j]['pname']+"&pprice="+data2[j]['pprice']+"&pcategory="+data2[j]['pcategory']+"&pimage=https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                                    const div_1 = document.createElement("div");
                                    div_1.className = "pimage";
                                    const product_img = document.createElement("img");
                                    product_img.src = "https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                                    product_img.alt = "product_image";
                                    div_1.appendChild(product_img);
                                    a_tag.appendChild(div_1);

                                    const div_2 = document.createElement("div");
                                    div_2.className = "pname";
                                    const p_1_div_2 = document.createElement("p");
                                    p_1_div_2.innerHTML = data2[j]['pname'];
                                    div_2.appendChild(p_1_div_2);
                                    a_tag.appendChild(div_2);

                                    const div_3 = document.createElement("div");
                                    div_3.className = "pprice";
                                    const p_1_div_3 = document.createElement("p");
                                    p_1_div_3.innerHTML = "Rs." + data2[j]['pprice'];
                                    div_3.appendChild(p_1_div_3);
                                    a_tag.appendChild(div_3);
                                    element.appendChild(a_tag);
                                }
                            }
                        }
                    }

                }
                else {
                    document.getElementById(under_scored_pcategory).style.backgroundColor = 'rgb(255, 186, 106';
                    // hide(under_scored_pcategory_product_list);
                }
            }
        }
    }
}

function quantity_add(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    quantity += 1;

    document.getElementById(quantity_id).innerHTML = String(quantity);
}

function quantity_reduce(quantity_id) {
    var quantity = parseInt(document.getElementById(quantity_id).innerHTML);
    if (quantity > 0) {
        quantity -= 1;
    }
    document.getElementById(quantity_id).innerHTML = String(quantity);
}


var ajax1 = new XMLHttpRequest();
ajax1.open("GET", "distinct_categories.php", true);
ajax1.send();
ajax1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var data1 = JSON.parse(this.responseText);
        for (var i = 0; i < data1.length; i++) {
            console.log(data1[i]);
            var under_scored_pcategory = "category_" + String(i);
            var under_scored_pcategory_product_list = under_scored_pcategory + "_product_list";
            console.log(currently_selected_category);
            if (currently_selected_category == under_scored_pcategory) {
                console.log("hello");
                var ajax2 = new XMLHttpRequest();
                ajax2.open("GET", "product_list.php?category=" + data1[i]['pcategory'], true);
                ajax2.send();
                ajax2.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var data2 = JSON.parse(this.responseText);
                        console.log(data2);
                        for (var j = 0; j < data2.length; j++) {
                            const a_tag = document.createElement("a");
                            
                            a_tag.href = "http://localhost/project/user_coffee_shop/product_page.php?table=<?php echo $table_no?>&pid="+data2[j]['id']+"&pname="+data2[j]['pname']+"&pprice="+data2[j]['pprice']+"&pcategory="+data2[j]['pcategory']+"&pimage=https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                            const div_1 = document.createElement("div");
                            div_1.className = "pimage";
                            const product_img = document.createElement("img");
                            product_img.src = "https://foodandroad.com/wp-content/uploads/2021/04/masala-chai-indian-drink-3-500x500.jpg";
                            product_img.alt = "product_image";
                            div_1.appendChild(product_img);
                            a_tag.appendChild(div_1);

                            const div_2 = document.createElement("div");
                            div_2.className = "pname";
                            const p_1_div_2 = document.createElement("p");
                            p_1_div_2.innerHTML = data2[j]['pname'];
                            div_2.appendChild(p_1_div_2);
                            a_tag.appendChild(div_2);

                            const div_3 = document.createElement("div");
                            div_3.className = "pprice";
                            const p_1_div_3 = document.createElement("p");
                            p_1_div_3.innerHTML = "Rs." + data2[j]['pprice'];
                            div_3.appendChild(p_1_div_3);
                            a_tag.appendChild(div_3);
                            element.appendChild(a_tag);
                        }
                    }
                }
            }
        }
    }
}

</script>
</html>


