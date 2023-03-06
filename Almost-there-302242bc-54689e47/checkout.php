
<?php include_once('partials/menu.php'); ?>

    <main> <!-- main content. This line will make the footer stay at the bottom of the page even if the content does not reacht the bottom -->
    <div class="container">

<?php



try {
    $ordernr = rand(1000000000, 9999999999);
    $stmt = $conn->prepare("SELECT * FROM tbl_order WHERE ordernr = $ordernr");
    $stmt->execute();
    $res = $stmt->fetchAll();
    $count = $stmt->rowCount();
    if($count > 0) {
        $ordernr = rand(1000000, 9999999);
    } else {
        $ordernr = $ordernr;
        // set ordernr in Session
        $_SESSION['ordernr'] = $ordernr;
    }
    

} catch(PDOException $e) {

    echo "Error: " . $e->getMessage();

}


if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE id IN (".implode(',',$_SESSION['cart']).")");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $total = 0;
            echo "<h1>Checkout</h1>";
            echo "<div class='container'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-light'><tr><th>Product Name</th><th>Product Price</th><th>Quantity</th><th>Subtotal</th></tr></thead>";
            echo "<tbody>";
            foreach ($res as $row) {
                $product_id = $row['id'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                if(isset($_SESSION['cart_quantity'][$product_id])){
                    $product_quantity = $_SESSION['cart_quantity'][$product_id];
                }else{
                    $product_quantity = 1;
                    $_SESSION['cart_quantity'][$product_id] = 1;
                }
                $subtotal = $product_quantity * $product_price;
                $total += $subtotal;
                echo "<tr><td>".$product_name."</td><td>€ ".$product_price."</td><td>".$product_quantity."</td><td>€ ".$subtotal."</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<div class='text-right'><b>Total Price:</b> € ".$total."</div>";
            echo "</div>";
            echo "<form method='post' action='process_order.php' class='container'>";
            echo "<div class='form-group'>";
            echo "<label for='customer_name'>* Full Name:</label>";
            echo "<input type='text' class='form-control' id='customer_name' name='customer_name' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='customer_address'>* Street + Housenr.:</label>";
            echo "<input type='text' class='form-control' id='customer_address' name='customer_address' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='customer_postcode'>* Postcode:</label>";
            echo "<input type='text' class='form-control' id='customer_postcode' name='customer_postcode' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='customer_city'>* City:</label>";
            echo "<input type='text' class='form-control' id='customer_city' name='customer_city' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='customer_email'>* Email:</label>";
            echo "<input type='customer_email' class='form-control' id='customer_email' name='customer_email' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='customer_phone'>* Phone:</label>";
            echo "<input type='text' class='form-control' id='customer_phone' name='customer_phone' required>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='payment_method'>* Payment Method:</label>";
            echo "<select class='form-control' id='payment_method' name='payment_method' required>";
            echo "<option value=''>Select Payment Method</option>";
            echo "<option value='ideal'>iDeal</option>";
            echo "<option value='paypal'>PayPal</option>";
            echo "<option value='creditcard'>Credit Card</option>";
            echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='comment'>Comment:</label>";
            echo "<textarea class='form-control' id='comment' name='comment' rows='3'></textarea>";
            echo "</div>";

            echo "<input type='hidden' name='food' value='".$product_name."'>";
            echo "<input type='hidden' name='price' value='".$product_price."'>";
            echo "<input type='hidden' name='quantity' value='".$product_quantity."'>";
            echo "<input type='hidden' name='total' value='".$total."'>";
            echo "<input type='hidden' name='ordernr' value='".$ordernr."'>";
            echo "<input type='hidden' name='status' value='new'>";
            echo "<input type='submit' name='submit' value='Place Order' class='btn btn-primary'>";
            echo "</form>";
        }else{
            echo "<div class='container'>";
            echo "<div class='alert alert-danger'>No products in cart</div>";
            echo "</div>";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}else{
    echo "<div class='container'>";
    echo "<div class='alert alert-danger'>No products in cart</div>";
    echo "</div>";
}


?>

    </div>
    </div>
    </main>
    <?php include_once('partials/footer.php'); ?>