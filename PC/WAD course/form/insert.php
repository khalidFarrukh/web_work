<?php

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$cnic = $_POST['cnic'];

$host = "localhost";
$root_name = "root";
$root_password = "";
$dbname = "mydatabase";

$con = mysqli_connect($host,$root_name,$root_password,$dbname);

if(!$con)
{
    die("Connection failed!" . mysqli_connect_error());
}

$sql = "INSERT INTO signed_up (id, username, password,email,cnic) VALUES ('0', '$username', '$password', '$email','$cnic')";

$rs = mysqli_query($con, $sql);
if($rs)
{
    echo "Sign up successfull";
}

// close connection
mysqli_close($con);
?>