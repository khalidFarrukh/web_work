<?php

$id = $_GET['id'];
$pname = $_POST['pname'];
$pprice = $_POST['pprice'];
$pcategory = $_POST['pcategory'];

$conn = new mysqli("localhost", "root", "", "project");
$q =  "update product_table set pname = '" . $pname . "', pprice = '" . $pprice . "', pcategory = '" . $pcategory . "' where id = '" . $id . "'";


if ($conn->query($q) == true) {
	header("Location:index.php");
} else {
	echo $conn->error;
}
