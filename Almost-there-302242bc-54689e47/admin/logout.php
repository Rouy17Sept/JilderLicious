
<?php 

//Need partials/menu.php to get the session_start() and the SITEURL constant
include_once('partials/menu.php'); 

session_destroy(); //Destroys $_SESSION and most importantly logs out the user

header('location:'.SITEURL.'admin/login.php');

?>

