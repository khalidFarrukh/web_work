<?php

$username = $_POST['userName'];
$phone = $_POST['phoneNumber'];
$pswd = $_POST['passWord'];

$conn = new mysqli("localhost","root","","project");
$q = "SELECT * from `user_login_info` where userName= '$username' AND phoneNumber='$phone' AND passWord='$pswd'";
$result = mysqli_query($conn,$q);
if(mysqli_num_rows($result)==0){
	$q = "SELECT MAX(id) AS 'max_id' FROM `user_login_info`";
	$ds = $conn->query($q);
	if($row=$ds->fetch_assoc()){
		$max_id = $row['max_id'];
		$q = "INSERT into user_login_info(userName,phoneNumber,passWord)values('".$username."','".$phone."','".$pswd."')";
		if($conn->query($q)==true){
			$q = "CREATE TABLE `project`.`".strval($max_id+1)."_cart_info` (`pid` INT(5) NOT NULL AUTO_INCREMENT , `pname` VARCHAR(255) NOT NULL , `pprice` INT(10) NOT NULL , `pcategory` VARCHAR(255) NOT NULL , `pquantity` INT(2) NOT NULL , `dining_table` VARCHAR(255) NOT NULL , `pimage` VARCHAR(255) NOT NULL , PRIMARY KEY (`pid`)) ENGINE = InnoDB;";
			if($conn->query($q)==true){
				echo "<script>alert('user account created')</script>";
				echo "<script>window.location.replace('login.php')</script>";
			}
			else{
				echo $conn->error;
				echo "<script>alert('there was an error while creating user account')</script>";
				echo "<script>window.location.replace('login.php')</script>";
			}
			
		}else{
			echo $conn->error;
			echo "<script>alert('there was an error while creating user account')</script>";
			echo "<script>window.location.replace('login.php')</script>";
		}
	}else{
		echo $conn->error;
		echo "<script>alert('there was an error while creating user account')</script>";
		echo "<script>window.location.replace('login.php')</script>";
	}
	
}else{
	echo "<script>alert('user already exist')</script>";
	echo "<script>window.location.replace('login.php')</script>";
	exit();
}

?>