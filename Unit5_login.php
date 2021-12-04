<?php
// Start the session
session_start();
// Set session variables
$_SESSION["role"] = 0;

if (empty($_POST['email'] || empty($_POST['password'])){
        header("Location: Unit5_index.php?err=Invalid User");
}
?>