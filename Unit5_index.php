 <?php include 'Unit5_header.php';?>
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
<p>Welcome! Please login or select Continue as Guest to begin.</p>
<fieldset class="personal">
                <br>
                E-mail: <input type="email" name="email" required><br>
                First Name: <input type="text" name="password" required><br>
                <button type="submit">Login</button><br>
                Remember me<input type="checkbox" name="inactive" id="inactive"><br>
                <p>Forgot password?<p>
        </fieldset>
        <a href="Unit5_store.php"><button style="background-color:pink">Continue As Guest</button></a>



</body>
</html>

 <?php include 'Unit5_footer.php';?>