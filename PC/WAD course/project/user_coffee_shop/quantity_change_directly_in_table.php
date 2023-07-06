<?php
session_start();
$uid  = $_SESSION['coffee_shop_user_id'];
$pid = $_GET['pid'];
$pquantity = $_GET['pquantity'];

$conn = new mysqli("localhost","root","","project");
$q =  "update ".strval($uid)."_cart_info set pquantity=$pquantity where pid=$pid";
$ds = $conn->query($q);
$data = array();
$data[] = "quantity_changed";
echo json_encode($data);
?>