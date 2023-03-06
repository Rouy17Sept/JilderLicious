
<?php include_once('partials/menu.php'); ?>

<style>



</style>

<main> <!-- main content. This line will make the footer stay at the bottom of the page even if the content does not reacht the bottom -->
<div class="cart-container content-center">

<?php

if(isset($_SESSION['cart'])){
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE id IN (".implode(',',$_SESSION['cart']).")");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $total_price = 0;
            echo "<h1 class='text-center mb-5 text-black'>CART</h1>";
            echo "<div class='cart-container'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-light'><tr><th>Product Name</th><th>Product Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr></thead>";
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
                $total_price += $subtotal;
                echo "<tr><td>".$product_name."</td><td>€ ".$product_price."</td>";
                echo "<td><form method='post' action='update_cart.php'><input type='number' name='quantity' value='$product_quantity' min='1' max='10' class='form-control'><input type='hidden' name='product_id' value='$product_id'><input type='submit' value='Update' class='btn btn-primary'></form></td>";
                echo "<td>€ ".$subtotal."</td>";
                echo "<td><form method='post' action='remove_from_cart.php'><input type='hidden' name='product_id' value='$product_id'><input type='submit' value='Remove' class='btn btn-danger'></form></td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<div class='text-right'><b>Total Price:</b> € ".$total_price."</div>";
            echo "<div class='text-right'><a href='clear_cart.php' class='btn btn-danger'>Clear Cart</a></div>";
            echo "</div>";
            echo "<div class='container'>";
            echo "<form method='post' action='' class='form-group'>
            <input type='text' name='coupon' placeholder='Enter coupon code' class='form-control'>
            <input type='submit' value='Apply Coupon' class='btn btn-primary'>
            </form>";
            echo "<div class='text-right'>
            <a href='checkout.php' class='btn btn-success'>Checkout</a>
            </div>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>No products in the cart.</div>";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 42000) {
            echo "
            <div class='alert alert-danger'>
            No products in the cart.
            </div>
            <a href='index.php' class='btn btn-primary center'>
            Go Back
            </a>
            ";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}else{
    echo "
    <div class='alert alert-danger'>
    No products in the cart.
    </div>
    <a href='index.php' class='btn btn-primary center'>
    Go Back
    </a>
    ";
}

?>

</div>
</main>
<?php include_once('partials/footer.php'); ?>