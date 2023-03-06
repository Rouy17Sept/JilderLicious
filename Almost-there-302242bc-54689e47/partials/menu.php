
<!-- This is the start of every page -->

<?php
    //In this file is the connection to the database and session_start() is called
    require_once 'constants.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Makes the website responsive -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>JilderLicious Food</title>
    
    <!-- Link BOOTRSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- link BOOTSTRAP JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- BOOTSTRAP AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Link naar eigen CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- favicon  -->
    <link rel="shortcut icon" href="img/jilderlicious-low-resolution-color-logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!-- Boxixon CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Boxicon CDN -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <!-- Boxicon JS -->
    <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- import my own JS -->
    <script src="script.js"></script>

</head>



<body class="background-gradient" id="content">

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            <img src="img/jilderlicious-low-resolution-logo-white-on-transparent-background.png" width="100" class="d-inline-block align-top" alt="">
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category.php">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>

<!-- 

            <li>
                <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
                </form>
            </li>

-->

            <li class="nav-item">
                <a class="nav-link" href="order.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </li>
            <li class="nav-item">
                
                <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a class="nav-link" href="admin/index.php">Admin</a>';
                    } else {
                        echo '<a class="nav-link" href="admin/login.php">Login</a>';
                    }
                ?>
            </li>
        </ul>
    </nav>

</body>