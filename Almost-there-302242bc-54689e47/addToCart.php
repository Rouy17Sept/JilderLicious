
<?php

    session_start();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    array_push($_SESSION['cart'], $_GET['food_id']);
    print_r($_SESSION['cart']);

?>
