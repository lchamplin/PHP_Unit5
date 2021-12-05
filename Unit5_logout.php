<?php
// Start the session
session_start();
// remove all session variables
$_SESSION = array();
session_unset();
// destroy the session
session_destroy();
header("Location: Unit5_index.php");

?>