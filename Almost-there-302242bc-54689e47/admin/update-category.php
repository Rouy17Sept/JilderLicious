
<?php include_once('partials/menu.php'); ?>

<?php

// Check if ID is set or not

if(!isset($_GET['id']))
{
    // ID not set, redirect to manage category page
    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
    header('location:admin/manage-category.php');
} else {
    try {
        $stmt = $conn->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $category = $stmt->fetch();
        $id = $category['id'];
        $category_name = $category['category_name'];
        $active = $category['active'];
        $favorite = $category['favorite'];
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!-- Form to Edit Category -->

<div class="container">
    <div class="form-group">
        <h1>EDIT <?php echo $category_name; ?></h1>
        <br><br>

        <form action="" method="post">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo $category_name; ?>">
            </div>
            <div class="form-group">
                <label for="active">Active</label>
                <select name="active" id="active" class="form-control">
                    <option value="1" <?php if($active == 1) { echo "selected"; } ?>>Yes</option>
                    <option value="0" <?php if($active == 0) { echo "selected"; } ?>>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="favorite">Favorite</label>
                <select name="favorite" id="favorite" class="form-control">
                    <option value="1" <?php if($favorite == 1) { echo "selected"; } ?>>Yes</option>
                    <option value="0" <?php if($favorite == 0) { echo "selected"; } ?>>No</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit']))
{
    $id2 = $_POST['id'];
    $category_name2 = $_POST['category_name'];
    $active2 = $_POST['active'];
    $favorite2 = $_POST['favorite'];

    try {
        $stmt = $conn->prepare("UPDATE category SET category_name = :category_name, active = :active, favorite = :favorite WHERE id = :id");
        $stmt->execute([':category_name' => $category_name2, ':active' => $active2, ':favorite' => $favorite2, ':id' => $id2]);
        $_SESSION['update'] = "<div class='alert alert-success'>Category updated successfully.</div>";
        header('location:admin/manage-category.php');
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>  