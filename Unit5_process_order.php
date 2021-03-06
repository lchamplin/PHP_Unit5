 <?php include 'Unit5_header.php';?>
<?php include 'Unit5_database.php';?>


<?php
function debug_to_console($data) {
	$output = $data;
	if (is_array($output))
		$output = implode(',', $output);
	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
// $product = $_POST["product"];
// $quantity = floatval($_POST["quantity"]);
// $price = floatval(explode("-", $_POST["product"])[1]);
// $subtotal = $price * $quantity;
// $tax_price = $subtotal * 1.03;
// $round_price = ceil($tax_price);

// $donation = "";
// if($_POST["donate"]){
//         $donation = "Total with donation: $" . strval($round_price);
// }
$conn = getConnection();
$newCust = findCustomer($conn, $_POST['email']);

$product = findProductById($conn, $_POST['product']);

$product_name = $product['product_name'];

$price = $product['price'];
$subtotal = $price * $_POST["quantity"];
$tax = $subtotal * 0.03;
$tax_price = $subtotal + $tax;
$total = $tax_price;
$timestamp = $_POST["timestamp"];
$donation_text = "";
$donation = 0.0;

$newQty = $product['in_stock'] - $_POST["quantity"];
if ($newQty < 0) { // ensure no negative amounts
$newQty = 0;
}

debug_to_console($_POST);

updateQuantity($conn, $_POST['product'], $newQty);

if($_POST["donate"]){
	$total = ceil($tax_price);
	$donation = $total - $tax_price;
        $donation_text = "Total with donation: $" . $total;
}

if ($newCust != 0) {
	addOrder($conn, $newCust['id'], $_POST['product'], $_POST["quantity"], $price, $tax, $donation, $total, $timestamp);
}
else{
	addCustomer($conn, $_POST['fname'], $_POST['lname'], $_POST['email']);
	$cust = findCustomer($conn, $_POST['email']);
	addOrder($conn, $cust['id'], $_POST['product'], $_POST["quantity"], $price, $tax, $donation, $total, $timestamp);
}
?>



<html>
<head>
	<title>PHP Store</title>
	<meta charset="UTF-8">
	<meta name="author" content="Lauren Champlin">
	<link rel="stylesheet" href="Unit5_process_order.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<br>
<br>

<p>Hello <?php echo $_POST["fname"]; ?> <?php echo $_POST["lname"]; ?>
<?php
if ($newCust==0) { 
	echo " - <em>Thank you for becoming a customer!</em></p>";
} else { 
	echo " - <em>Welcome back!</em></p>"; 
}?>
<p>We hope you enjoy your <b><?php echo $product_name?></b> candy!</p>
<section id="receipt">
<p><b>Order Details:</b></p>
<p>	<?php echo $_POST["quantity"]?> <?php echo $product_name?> @ <?php echo $price?>:  $<?php echo $subtotal?></p>
<p>	Tax (3%): <?php echo $tax?> </p>
<p>	Subtotal: $<?php echo $tax_price?> </p>
<p>	<?php echo $donation_text ?> </p>
</section>
<p>We will send special offers to <?php echo $_POST['email']?><p>

<div id="offers" style="color:blue">Based on your viewing history we'd like to offer 20% off these items:</div>

</body>
</html>

 <?php include 'Unit5_footer.php';?>

<script>
findItems();

function findItems() {
        arr = getCookie("itemsViewed");
	if(arr.length>2){
		ul = document.createElement('ul');
		document.getElementById('offers').appendChild(ul);
		for (let i = 0; i < arr.length-1; i++){
    			let li = document.createElement('li');
    			ul.appendChild(li);
    			li.innerHTML += arr[i];
		}
	}
	else{
		document.getElementById("offers").innerHTML = "";
	}
}

function getCookie(name) {
	// Split cookie string and get all individual name=value pairs in an array
	var cookieArr = document.cookie.split(";");
	
	// Loop through the array elements
	for(var i = 0; i < cookieArr.length; i++) {
		var cookiePair = cookieArr[i].split("=");
		
		/* Removing whitespace at the beginning of the cookie name
		and compare it with the given string */
		if(name == cookiePair[0].trim()) {
			// Decode the cookie value and return
			return JSON.parse(cookiePair[1]);
		}
	}
	// Return null if not found
	return null;
}

</script>

