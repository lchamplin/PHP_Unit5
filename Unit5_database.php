<?php
error_reporting(E_ALL);
ini_set('display_errors', True);
?>
<?php
	function getConnection() {
		include'./Unit5_database_credentials.php';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
  
		// Check connection
  		if ($conn->connect_error) {
  			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}


function getProducts($conn){
$sql = "SELECT * FROM Product";
$result = mysqli_query($conn, $sql);
return $result;
}

function findUser($conn, $email, $password) {
        $query = "select * from Users where email = ? and password = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
        }
        else {
                return 0;
        }
}

function findProductById($conn, $productId) {
        $query = "select * from Product where id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
        }
        else {
                return 0;
        }
}

function findProductByName($conn, $name) {
        $query = "select * from Product where product_name = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id'];
        }
        else {
                return 0;
        }
}

function findCustomer($conn, $email) {
        $query = "select * from Customer where email = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
        }
        else {
                return 0;
        }
}

function findCustomerById($conn, $id) {
        $query = "select * from Customer where id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
        }
        else {
                return 0;
        }
}

function findOrder($conn, $custId, $productId, $timestamp) {
        $query = "select * from Orders where customer_id = ? and product_id = ? and timestamp = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("iii", $custId, $productId, $timestamp);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                return true;
        }
        else {
                return false;
        }
}

function getProductOrders($conn, $productId){
        $query = "select * from Orders where product_id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $stmt->close();
        if ($result->num_rows > 0) {
                return 1;
        }
        else {
                return 0;
        }
}

function addOrder($conn, $custId, $productId, $qty, $price, $tax, $donation, $total, $timestamp) {
        if(! findOrder($conn, $custId, $productId, $timestamp)){
                $query = "insert into Orders (product_id, customer_id, quantity, price, tax, donation, total, timestamp) values (?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare( $query );
                $stmt->bind_param("iiiddddi", $productId, $custId, $qty, $price, $tax, $donation, $total, $timestamp);
                $stmt->execute();
                $stmt->close();
        }
}

function addCustomer($conn, $first, $last, $email) {
        $query = "insert into Customer (first_name, last_name, email) values (?,?,?)";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("sss", $first, $last, $email);
        $stmt->execute();
        $stmt->close();
}

function addProduct($conn, $name, $image, $price, $quantity, $inactive) {
        $query = "insert into Product (product_name, image_name, price, in_stock, inactive) values (?,?,?,?,?)";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("ssdii", $name, $image, $price, $quantity, $inactive);
        $stmt->execute();
        $stmt->close();
}

function updateQuantity($conn, $productId, $qty) {
        $query = "update Product set in_stock = ? where id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("ii", $qty, $productId);
        $stmt->execute();
        $stmt->close();
}

function updateProductById($conn, $productId, $name, $image, $price, $quantity, $inactive) {
        $query = "update Product set product_name = ?, image_name = ?, price = ?, in_stock = ?, inactive = ? where id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("ssdiii", $name, $image, $price, $quantity, $inactive, $productId);
        $stmt->execute();
        $stmt->close();
}

function deleteProductById($conn, $productId) {
        $query = "delete from Product where id = ?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->close();
}

function getQuantity($conn, $productId) {
        $query = "select in_stock from Product where id =?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param("i", intval($productId));
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['in_stock'];
        }
        else {
                return 0;
        }
}

function getCustomerTable($conn) {
        $query = "select * from Customer";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
}

function getOrdersTable($conn) {
        $query = "select * from Orders";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
}

function getProductTable($conn) {
        $query = "select * from Product";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
}

function getProductTableHTML($conn){
        $products = getProductTable($conn);
        $table = "";

        $table = $table . "<br>";
        $table = $table .  "<h3> Products </h3>";
        $table = $table .  "<table id='display-table' border='1'><tr><th>Product</th><th>Image</th><th>Quantity</th><th>Price</th><th>Inactive?</th></tr>";

        while($row = mysqli_fetch_array($products))
        {
                $table = $table .  "<tr>";
                $table = $table .  "<td>" . $row['product_name'] . "</td>";
                $table = $table .  "<td>" . $row['image_name'] . "</td>";
                $table = $table .  "<td>" . $row['in_stock'] . "</td>";
                $table = $table .  "<td>" . $row['price'] . "</td>";
                if ($row['inactive']==1){
                        $table = $table .  "<td>" . "yes ". "</td>";
                }
                else{
                        $table = $table .  "<td>" . "</td>";
                }
                $table = $table . "<td style='display:none;'>" . $row['id'] . "</td>";
                $table = $table .  "</tr>";
        }
        $table = $table .  "</table>";
        return $table;
}

?> 
