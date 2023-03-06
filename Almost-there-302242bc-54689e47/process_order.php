<?php
// This includes the navbar, SITEURL, database connection and session_start
include_once('partials/menu.php');

$customer_name = $_POST['customer_name'];
$customer_address = $_POST['customer_address'];
$customer_postcode = $_POST['customer_postcode'];
$customer_city = $_POST['customer_city'];
$customer_email = $_POST['customer_email'];
$ip_address = $_SERVER['REMOTE_ADDR'];
$payment_method = $_POST['payment_method'];
$payment_status = "0";
$status = "new";
$customer_phone = $_POST['customer_phone'];
$total = $_POST['total'];
$food = $_POST['food'];
$price = $_POST['price'];
$comment = $_POST['comment'];

$ordernr = $_SESSION['ordernr'];

try {
    $conn->beginTransaction();
    foreach ($_SESSION['cart'] as $product_id) {
        $product_quantity = $_SESSION['cart_quantity'][$product_id];
        $stmt = $conn->prepare("SELECT * FROM product WHERE id=:id");
        $stmt->bindParam(":id", $product_id);
        $stmt->execute();
        $product = $stmt->fetch();

        $stmt = $conn->prepare("INSERT INTO tbl_order(ordernr, product_id, customer_name, customer_phone, customer_address, customer_postcode, customer_city, customer_email, payment_method, payment_status, quantity, created_at, updated_at, ip_address, status, total, price, food, comment) 
        VALUES(:ordernr, :product_id, :customer_name, :customer_phone, :customer_address, :customer_postcode, :customer_city, :customer_email, :payment_method, :payment_status,  :quantity, now(), now(),:ip_address, :status, :total, :price, :food, :comment)");
        $stmt->bindParam(":ordernr", $ordernr);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":customer_name", $customer_name);
        $stmt->bindParam(":customer_address", $customer_address);
        $stmt->bindParam(":customer_postcode", $customer_postcode);
        $stmt->bindParam(":customer_city", $customer_city);
        $stmt->bindParam(":customer_email", $customer_email);
        $stmt->bindParam(":quantity", $product_quantity);
        $stmt->bindParam(":ip_address", $ip_address);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":payment_method", $payment_method);
        $stmt->bindParam(":payment_status", $payment_status);
        $stmt->bindParam(":customer_phone", $customer_phone);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":price", $product['product_price']);
        $stmt->bindParam(":food", $product['product_name']);
        $stmt->bindParam(":comment", $comment);
        $stmt->execute();
    }

    $conn->commit();
    $_SESSION['added-order'] = "
    <div class='alert alert-success' role='alert'>
    <h4 class='alert-heading'>Success!</h4>
    <p>Order added successfully" . " " . "Order number:" . " " . $ordernr . "</p>
    <hr>
    <p class='mb-0'>When you refresh, you will be redirected to the homepage.</p>
    </div>
    ";

    $created_at = date("d-m-Y H:i:s");
    
    $to = $customer_email;

    /* Put your email address here !!
       And uncomment the line below!!

    $from = "info@yjilderda.nl";
        
        Put your email address here !!
       And uncomment the line above!!
    */


    $subject = "Order confirmation";
    $partOfDay = date("H");
    if ($partOfDay < 12) {
        $greeting = "Good morning";
    } else if ($partOfDay < 18) {
        $greeting = "Good afternoon";
    } else {
        $greeting = "Good evening";
    }


    $message = "
    Hi ". $greeting . $customer_name . ",
    Thank you for your order!
    We will contact you as soon as possible.

    This are the details of your order:
    Order number: " . $ordernr . "
    Date: " . $created_at . "
    Name: " . $customer_name . "
    Address: " . $customer_address . "
    Postcode: " . $customer_postcode . "
    City: " . $customer_city . "
    Phone: " . $customer_phone . "
    Email: " . $customer_email . "
    Payment method: " . $payment_method . "
    Comment: " . $comment . "
    Total: € " . $total . "

    

    Kind regards,
    Youri Jilderda
    https://yjilderda.nl/
    https://jilderlicious.yjilderda.nl/
    ";


    $headers = "From:
    " . $from;


    if (!mail($to, $subject, $message, $headers)) {
        $_SESSION['mail-error'] = "
        <div class='alert alert-danger' role='alert'>
        <h4 class='alert-heading'>Error!</h4>
        <p>There was an error sending the email. Please contact us!</p>
        <hr>
        <p class='mb-0'>When you refresh, you will be redirected to the homepage.</p>
        </div>
        ";
    }

    unset($_SESSION['cart']);
    unset($_SESSION['cart_quantity']);

    header("Location: order_success.php");
    
} catch(PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}

?>