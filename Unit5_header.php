
<head>
	<title>PHP Header</title>
	<meta charset="UTF-8">
	<meta name="author" content="Lauren Champlin">
	<link rel="stylesheet" href="Unit5_common.css">
	
</head>
<header id="header"> 
<h1>Candy Shop</h1>
</header>
<nav>
        <ul class="topnav">
                <!-- <a href="Unit5_store.php">Store</a>
                <a href="Unit5_order_entry.php">Order Entry</a>
                <a href="Unit5_adminProduct.php">Products</a>
                <a id="admin" href="Unit5_admin.php">Admin</a> -->
                <?php
                // Start the session
                session_start();
                // Init session variables
                $role = $_SESSION["role"];
                if($role == 0){
                        echo "<li style = 'float:right'><a href='Unit5_index.php'>Home</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_store.php'>Store</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_logout.php'>Logout</a></li>";   
                }
                if($role == 1){
                        echo "<li style = 'float:right'><a href='Unit5_index.php'>Home</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_order_entry.php'>Order Entry</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_admin.php'>Admin</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_logout.php'>Logout</a></li>";   
                }
                if($role == 2){
                        echo "<li style = 'float:right'><a href='Unit5_index.php'>Home</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_store.php'>Store</a></li>";
                        echo "<li style = 'float:right'><a href='Unit5_order_entry.php'>Order Entry</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_adminProduct.php'>Products</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_admin.php'>Admin</a></li>"; 
                        echo "<li style = 'float:right'><a href='Unit5_logout.php'>Logout</a></li>";  
                }
                ?>
        </ul>
        <br>
</nav>

