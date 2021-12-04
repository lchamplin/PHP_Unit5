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
<body onload="checkErr()">
<p id="message">Welcome! Please login or select Continue as Guest to begin.</p> 
<form action="Unit5_login.php" method="post">

<fieldset class="login">
                <br>
                E-mail: <input type="email" name="email" required><br>
                First Name: <input type="text" name="password" required><br>
                <button id="login" type="submit">Login</button><br>
                <span>
                Remember me<input type="checkbox" name="inactive" id="inactive">
                <p>Forgot password?<p>
                </span>
        </fieldset>
        <a href="Unit5_store.php"><button id="guest">Continue As Guest</button></a>
</form>


</body>
</html>

 <?php include 'Unit5_footer.php';?>

<script>
        function checkErr(){
                error = $_GET['err'];
                console.log(error);
                if(error){
                        $("#message").innerHTML+=("      "+error);
                }

        }

</script>