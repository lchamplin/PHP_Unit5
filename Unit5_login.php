<?php include 'Unit5_database.php';?>
<?php date_default_timezone_set("America/Denver");?>

<?php
// Start the session
session_start();
// Init session variables
$_SESSION["role"] = 0;
$_SESSION["password"] = "";
$conn = getConnection();

if (empty($_POST['email']) || empty($_POST['password'])){
        header("Location: Unit5_index.php?err=Invalid User");
}
$email = $_POST['email'];
$password = $_POST['password'];
$user = findUser($conn, $email, $password);

if ($user == 0){
        header("Location: Unit5_index.php?err=Invalid User");
}

if ($user['role']==1){
        $_SESSION["role"] = 1;
        header("Location: Unit5_order_entry.php");
}
if ($user['role']==2){
        $_SESSION["role"] = 2;
        header("Location: Unit5_admintProduct.php");
}


?>