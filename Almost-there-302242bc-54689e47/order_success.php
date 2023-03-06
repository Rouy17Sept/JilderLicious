
<?php include_once('partials/menu.php'); ?>

<?php

if (isset($_SESSION['added-order'])) {
    echo $_SESSION['added-order'];
    unset($_SESSION['added-order']);
} else {
    header("location: index.php");
}

if (isset($_SESSION['mail-error'])) {
    echo $_SESSION['mail-error'];
    unset($_SESSION['mail-error']);
}

?>


<?php include_once('partials/footer.php'); ?>