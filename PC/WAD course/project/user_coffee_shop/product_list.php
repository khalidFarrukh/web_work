<?php

$conn = new mysqli("localhost","root","","project");
$category = $_GET['category'];
$q = "SELECT * from `product_table` WHERE pcategory='$category'";
$ds = $conn->query($q);
$data = array();
while($row = $ds->fetch_assoc())
{
    $data[] = $row;
}
echo json_encode($data);
?>