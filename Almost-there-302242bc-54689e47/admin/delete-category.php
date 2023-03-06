
<?php include_once('partials/menu.php');

// Check if ID is set

$category_id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM category WHERE id = :id");
    $stmt->bindParam(':id', $category_id);
    $stmt->execute();
    $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>Category Deleted Successfully</div>";
    header('location:admin/manage-category.php');
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1451) {
        $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>Category cannot be deleted because it is used in a product.</div>";
        header('location:admin/manage-category.php');
    } else {
        echo "Error: " . $e->getMessage();
    }
}

?>
