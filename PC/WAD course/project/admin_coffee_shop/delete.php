<?php


$id = $_GET['id'];


$conn = new mysqli("localhost","root","","project");
$q = "delete from product_table where id =".$id;
if($conn->query($q)==true){
	header("Location:index.php");
}else{
	echo $conn->error;
}


?>