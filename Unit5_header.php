<?php
                // Start the session
                if (session_status() <> PHP_SESSION_ACTIVE) session_start();

                ?>
<head>
	<title>PHP Header</title>
	<meta charset="UTF-8">
	<meta name="author" content="Lauren Champlin">
	<link rel="stylesheet" href="Unit5_common.css">
	
</head>
<header id="header"> 
<h1>Candy Shop</h1>
<p>
<?php 
if (!isset($_SESSION["role"])){
   $role = 0;     
}
else{
        $role = $_SESSION["role"];
}
if($role != 0){
        echo "Welcome " . $_SESSION["name"];
}
        
        ?></p>
</header>
<nav>
        <div class="topnav">
                <!-- <a href="Unit5_store.php">Store</a>
                <a href="Unit5_order_entry.php">Order Entry</a>
                <a href="Unit5_adminProduct.php">Products</a>
                <a id="admin" href="Unit5_admin.php">Admin</a> -->
                <?php
                // get session variables
                $role = $_SESSION["role"];

                if($role == 0){
                        echo "<a href='Unit5_index.php'>Home</a>"; 
                        echo "<a href='Unit5_store.php'>Store</a>"; 
                        echo "<a style = 'float:right'  href='Unit5_logout.php'>Logout</a>";   
                }
                if($role == 1){
                        echo "<a href='Unit5_index.php'>Home</a><"; 
                        echo "<a href='Unit5_order_entry.php'>Order Entry</a>"; 
                        echo "<a href='Unit5_admin.php'>Admin</a>"; 
                        echo "<a style = 'float:right' href='Unit5_logout.php'>Logout</a>";   
                }
                if($role == 2){
                        echo "<a href='Unit5_index.php'>Home</a>"; 
                        echo "<a href='Unit5_store.php'>Store</a>";
                        echo "<a href='Unit5_order_entry.php'>Order Entry</a>"; 
                        echo "<a href='Unit5_adminProduct.php'>Products</a>"; 
                        echo "<a href='Unit5_admin.php'>Admin</a>"; 
                        echo "<a style = 'float:right' href='Unit5_logout.php'>Logout</a>";  
                }
                ?>
        </div>
        <br>
</nav>

