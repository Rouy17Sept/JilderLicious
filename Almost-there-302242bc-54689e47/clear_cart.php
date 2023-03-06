

<?php

    session_start();

    // Unset al de data data van $_SESSION['cart'] en $_SESSION['cart_quantity']
    // en redirect naar order.php

    unset($_SESSION['cart']);
    unset($_SESSION['cart_quantity']);
    header("Location: order.php");
    exit();
    
?>