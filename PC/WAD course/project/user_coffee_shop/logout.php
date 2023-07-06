<?php
session_start();
if(isset($_SESSION['coffee_shop_user_id']))
{
    unset($_SESSION['coffee_shop_user_id']);
}
header("Location:login.php");
?>
