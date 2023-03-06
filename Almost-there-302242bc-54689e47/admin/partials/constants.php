<?php

/*

session_start();

ob_start();

try {
    $conn = new PDO("mysql:host=!!;dbname=!!", "!!", "!!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

define('SITEURL', 'https://jilderlicious.yjilderda.nl/');

*/


session_start();

ob_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=yfood", "bit_academy", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

define('SITEURL', 'http://localhost/bit-academy/php-eindproject/Almost-there-302242bc-54689e47/');


    // if USER ROLE = NULL. This should only happen when someone is trying to use the website for the first time at his local host.
    if (!isset($_SESSION['user_role'])) {
        // if url is not add-user.php, redirect to add-user.php
        if (basename($_SERVER['PHP_SELF']) != 'add-user.php') {
            header('location:admin/add-user.php');
        }
    }

?>