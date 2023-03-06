
<?php include_once('partials/menu.php');

// Check if ID is set

if (!isset($_GET['id'])) {
    $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>No ID set</div>";
    header('location:admin/manage-category.php');
} else {
    $product_id = $_GET['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM product WHERE id = :id");
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();
        $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>Product Deleted Successfully</div>";
        header('location:admin/manage-product.php');
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1451) {
            $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>Product cannot be deleted because it is used in a order.</div>";
            header('location:admin/manage-product.php');
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>