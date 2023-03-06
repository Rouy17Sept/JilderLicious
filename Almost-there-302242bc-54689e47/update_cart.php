
<?php
    session_start();
    if(isset($_SESSION['cart']) && isset($_POST['product_id']) && isset($_POST['quantity'])){
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        if($quantity < 1)
            $quantity = 1;
        if($quantity > 10)
            $quantity = 10;
        $_SESSION['cart_quantity'][$product_id] = $quantity;
    }
    header("Location: order.php");
    exit();
?>