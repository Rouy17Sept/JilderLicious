
<?php

//Check if the user is logged in or not. If not, redirect to login page



if(!isset($_SESSION['user_id']))
{
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel.</div>";
    header('location:'.SITEURL.'admin/login.php');
}



?>