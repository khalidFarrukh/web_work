<?php

session_start();
if(!isset($_SESSION['coffee_shop_user_id']))
{
	header("Location:login.php");
}

$uid  = $_SESSION['coffee_shop_user_id'];
$table = $_GET['table'];
$pid = $_GET['pid'];
$pname = $_GET['pname'];
$pprice = $_GET['pprice'];
$pcategory = $_GET['pcategory'];
$pquantity = $_GET['pquantity'];
$pimage = $_GET['pimage'];

$conn = new mysqli("localhost","root","","project");
$q = "SELECT * from `".strval($uid)."_cart_info` where pname= '$pname' AND pcategory='$pcategory' AND dining_table= '$table'";
$ds = $conn->query($q);
$row = $ds->fetch_assoc();
if($row){
    $new_quantity = $pquantity+$row['pquantity'];
    $q =  "update ".strval($uid)."_cart_info set pquantity=$new_quantity where pid = ".$row['pid']."";
    $conn->query($q);
    $q = "SELECT COUNT(*) as `N_rows` FROM ".strval($uid)."_cart_info";
    $ds=$conn->query($q);
    $row = $ds->fetch_assoc();
    $data = array();
    if($row){
        $data = $row;
    }
    echo json_encode($data);
}
else{
    $q = "INSERT into ".strval($uid)."_cart_info(pname,pprice,pcategory,pquantity,dining_table,pimage)values('$pname','$pprice','$pcategory','$pquantity','$table','$pimage')";
    $conn->query($q);
    $q = "SELECT COUNT(*) as `N_rows` FROM ".strval($uid)."_cart_info";
    $ds=$conn->query($q);
    $row = $ds->fetch_assoc();
    $data = array();
    if($row){
        $data = $row;
    }
    echo json_encode($data);
}
?>