<?php include 'Unit5_database.php';?>


<html>
<head>
	<title>PHP Store</title>
	<meta charset="UTF-8">
	<meta name="author" content="Lauren Champlin">
	<link rel="stylesheet" href="Unit5_login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<header id="header"> 
<h1>Candy Shop</h1>
</header>
<p>Welcome! Please login or select Continue as Guest to begin.</p>
<?php 
// Start the session
session_start();
// Init session variables
$_SESSION["name"] = "";
if(isset($_GET['err'])){
        echo "<p style='color:red'>" . $_GET['err'] . "</p>";
}
?> 
<form action="Unit5_login.php" method="post">

<fieldset class="login">
                <br>
                E-mail: <input type="email" name="email"><br>
                Password: <input type="text" name="password"><br>
                <button id="login" type="submit">Login</button><br>
                Remember me<input type="checkbox" name="inactive" id="inactive">
                <p>Forgot password?<p>
        </fieldset>
        <a id="guest" href="Unit5_store.php">Continue as Guest</a>
</form>


</body>
</html>

 <?php include 'Unit5_footer.php';?>