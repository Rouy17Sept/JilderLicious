
<?php
    require_once 'partials/constants.php';
?>

<?php
// Check if the user is logged in or not.   
    require_once 'partials/login_check.php';
?>

<!-- Start of every page -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- This makes the website responsive for mobile users -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JilderLicious Admin</title>
    
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

    <!-- Link eigen CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            <img src="img/admin.png" width="100" class="d-inline-block align-top" alt="">
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage-category.php">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage-product.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage-user.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage-order.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage-contact.php">Contact</a>
            </li>

            <!-- Hieronder staat de code voor de administrator pagina, deze is uitgezet omdat deze pagina nog niet af is. Hiermee kan in de toekomst dit product als whitelabel verder.


            <li class="nav-item">
                <a class="nav-link" href="administrator.php">Administrator</a>
            <li class="nav-item">

            -->


                <a class="nav-link" href="<?php echo SITEURL; ?>">Website</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Hier start de content van elke pagina en stopt de Navbar -->
