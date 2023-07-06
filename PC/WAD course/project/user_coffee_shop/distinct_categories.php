<?php
$conn = new mysqli("localhost","root","","project");
$q = "SELECT distinct(pcategory) from `product_table`";
$ds = $conn->query($q);
$data = array();
while($row = $ds->fetch_assoc())
{
    $data[] = $row;
}
echo json_encode($data);
?>