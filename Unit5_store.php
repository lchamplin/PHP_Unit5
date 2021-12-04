<?php include 'Unit5_header.php';?>
<?php include 'Unit5_database.php';?>
<?php date_default_timezone_set("America/Denver");?>



<html>
<head>
	<title>PHP Store</title>
	<meta charset="UTF-8">
	<meta name="author" content="Lauren Champlin">
	<link rel="stylesheet" href="Unit5_store.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body onload="clearItems()">

<form action="Unit5_process_order.php" method="post">
        <span>
        <br>
        <div class="personal">
        <fieldset class="personal">
    <legend>Personal</legend>
                <br>
                First Name: * <input type="text" name="fname" required pattern="[a-zA-Z'].{1,}"><br>
                Last Name: * <input type="text" name="lname" required pattern="[a-zA-Z'].{1,}"><br>
                E-mail: * <input type="email" name="email" required><br>
        </fieldset>
        </div>

          <div class="product">
   <fieldset class="product">
    <legend>Product</legend>
                <br>
      
                <select id="product" name="product" required onchange="showImage()">
                        <option disabled selected hidden>Choose a product *</option>
                        <?php $Product = getProducts(getConnection()); ?>
                        <?php if ($Product): ?>
                        <?php foreach($Product as $row): ?>
                                <option value = <?= $row['id']?> data-name="<?= $row['product_name'] ?>" data-image="<?= $row['image_name'] ?>" data-qty="<?= $row['in_stock'] ?>" <?php if($row['inactive']==1){ echo "disabled"; } ?> > <?= $row['product_name'] ?> - <?= $row['price'] ?> </option>
                        <?php endforeach?>
                        <?php endif?>
                        </select>


                <br>
                Quantity: * <input type="number" name="quantity" min=1 max=100  value=1 required><br>
</fieldset>
                <p>Would you like to round up to donate?</p>
                <span>
                        <input type="radio" id="yes" name="donate" value=1>
                        <label for="Yes">Yes</label><br>
                        <input type="radio" id="css" name="donate" value=0 checked>
                        <label for="No">No</label><br>
                </span>
        <input type="hidden" name="timestamp" value="<?php echo time(); ?>" required>
</div>
        <button id="submit" type="submit">Purchase</button>
</span>

</form>
<div class="picture">
        <p id="pic_text">Select a product to see it here</p>
        <img id="picture">
        <p id="stock_text"></p>

</div>
</body>
</html>

 <?php include 'Unit5_footer.php';?>

<script>
        function showImage() {
                var imgName = $("#product option:selected").attr('data-image');
                var stock = $("#product option:selected").attr('data-qty');
                $('#picture').attr("src", "images/"+imgName.toString());
                if (stock == 0){
                        $('#stock_text').text("OUT OF STOCK");
                        $('#stock_text').css('color', 'red');
                        $('#submit').prop("disabled",true);
                }
                else if (stock < 5){
                        $('#stock_text').text("Only "+stock+" left in stock!");
                        $('#stock_text').css('color', 'blue');
                        $('#submit').prop("disabled",false);
                }
                else{
                        $('#stock_text').text("");
                        $('#submit').prop("disabled",false);
                }
                console.log($("#product option:selected").attr('data-name'));
                addToCookie($("#product option:selected").attr('data-name'));
        }
        // get the itemsViewed cookie. This will hold the list of items the user has viewed. NOTE: be sure you read about JSON parse etc. in the background info.
        // if the currently selected item is not in the array, add it (see links in assignment writeup related to JS arrays)
        // stringify the array and use setCookie to store it
        function addToCookie(product){
                arr = getCookie("itemsViewed");
                console.log(typeof arr);
                if (!arr.includes(product)){
                        arr.push(product);
                        var json_str = JSON.stringify(arr);
                        document.cookie = "itemsViewed=" + json_str
                }
        }

        function getCookie(name) {
                console.log("getCookie");
                // Split cookie string and get all individual name=value pairs in an array
                var cookieArr = document.cookie.split(";");
                console.log(cookieArr);
                
                // Loop through the array elements
                for(var i = 0; i < cookieArr.length; i++) {
                        var cookiePair = cookieArr[i].split("=");
                        
                        /* Removing whitespace at the beginning of the cookie name
                        and compare it with the given string */
                        if(name == cookiePair[0].trim()) {
                                // Decode the cookie value and return
                                console.log(decodeURIComponent(cookiePair[1]));
                                return decodeURIComponent(cookiePair[1]);
                        }
                }
                // Return null if not found
                return null;
        }


        function clearItems(){
                var arr = [];
                var json_str = JSON.stringify(arr);
                document.cookie = "itemsViewed=" + json_str
        }

</script>