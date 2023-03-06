
<?php

// This code will delete a specific product from the cart

    session_start();
    if(isset($_SESSION['cart']) && isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        $key = array_search($product_id, $_SESSION['cart']);
        if($key !== false){
            unset($_SESSION['cart'][$key]);
            unset($_SESSION['cart_quantity'][$product_id]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            $_SESSION['cart_quantity'] = array_values($_SESSION['cart_quantity']);
        }
    }
    header("Location: order.php");
    exit();
?>
