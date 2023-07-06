<?php
$uname = $_POST['userName'];
$pswd = $_POST['passWord'];

session_start();

$conn = new mysqli("localhost","root","","project");

$q = "SELECT * from `user_login_info` WHERE userName='$uname' AND passWord='$pswd'";
$ds = $conn->query($q);
if($row=$ds->fetch_assoc()){
	$user_id = $row['id'];
	$_SESSION['coffee_shop_user_id'] = $user_id;
	header("Location:home.php");
}
else{
	echo "<script>alert('incorrect username or password')</script>";
	echo "<script>window.location.replace('login.php')</script>";
	exit();
}

?>