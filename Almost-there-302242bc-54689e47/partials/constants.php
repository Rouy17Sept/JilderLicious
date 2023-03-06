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



?>