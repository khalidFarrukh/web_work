<?php

session_start();
$uid  = $_SESSION['coffee_shop_user_id'];
$pid = $_GET['pid'];

$conn = new mysqli("localhost","root","","project");
$q =  "delete from ".strval($uid)."_cart_info where pid=$pid";
$ds = $conn->query($q);
$data = array();
$data[] = "product_deleted";
echo json_encode($data);
?>