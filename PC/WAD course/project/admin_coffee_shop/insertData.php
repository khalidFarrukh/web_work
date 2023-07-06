<?php


$pname = $_POST['pname'];
$pprice = $_POST['pprice'];
$pcategory = $_POST['pcategory'];

$conn = new mysqli("localhost","root","","project");
$q = "insert into product_table(pname,pprice,pcategory)values('".$pname."','".$pprice."','".$pcategory."')";
if($conn->query($q)==true){
	header("Location:index.php");
}else{
	echo $conn->error;
}


?>