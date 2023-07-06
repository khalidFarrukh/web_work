<?php
session_start();
if(isset($_SESSION['coffee_shop_user_id']))
{
	header("Location:home.php");
}
else{
	header("Location:login.php");
}
?>


