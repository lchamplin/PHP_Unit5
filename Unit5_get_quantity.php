<?php include 'Unit5_database.php';?>


<?php

$conn = getConnection();
$id = $_GET["id"];
$quantity = getQuantity($conn, $id);
echo $quantity;
?>
