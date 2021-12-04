<?php include 'Unit4_database.php';?>


<?php

$conn = getConnection();
$id = $_GET["id"];
$quantity = getQuantity($conn, $id);
echo $quantity;
?>
