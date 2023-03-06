
<?php include_once('partials/menu.php'); ?>
<?php

// check if id is set or not

if(!isset($_GET['id']))
{
    // id not set, redirect to manage product page
    $_SESSION['no-product-found'] = "<div class='error'>Product not found.</div>";
    header('location:admin/manage-product.php');
} else {
    try {
        $stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $product = $stmt->fetch();
        $id = $product['id'];
        $product_name = $product['product_name'];
        $product_description = $product['product_description'];
        $product_price = $product['product_price'];
        $product_image = $product['product_image'];
        $category_id = $product['category_id'];
        $active = $product['active'];
        $favorite = $product['favorite'];
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<!-- start form to edit product -->
<div class="container">
    <div class="form-group">
        <h1>EDIT <?php echo $product_name; ?></h1>
        <br><br>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $product_name; ?>">
        </div>
        <div class="form-group">
            <label for="product_description">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control"><?php echo $product_description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                <input type="number" name="product_price" id="product_price" class="form-control" min="0.00" step="0.01" value="<?php echo $product_price; ?>">
        </div>

        
        <div class="form-group">
            <label for="product_image">Product Image</label>
            <?php
                if($product_image != "")
                {
                    // display image
                    ?>
                    <img src="imgFood/<?php echo $product_image; ?>" width="100px">
                    <?php
                } else {
                    // display message
                    echo "<div class='error'>Image not added.</div>";
                }
            ?>
        </div>
        <div class="form-group">
            <label for="product_image">Change Image</label>
            <input type="file" name="product_image" id="product_image" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="category_id">Category ID</label>
            <select name="category_id" id="category_id">

            <?php

            $stmt2 = $conn->prepare("SELECT id, category_name FROM category WHERE active='YES'");
            $stmt2->execute();
            $result2 = $stmt2->fetchAll();
            if (count($result2) > 0) {
                foreach ($result2 as $row2) {
                    $cat_id = $row2['id'];
                    $category_name = $row2['category_name'];
                    ?>
                    <option value="<?php echo $cat_id; ?>" <?php if($category_id == $cat_id) { echo "selected"; } ?>><?php echo $category_name; ?></option>
                    <?php
                }
            } else {
                ?>
                <option value="0">No category found</option>
                <?php
            }

            ?>
        </select>        
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
            <input type="submit" name="submit" value="Update Product" class="btn btn-primary">
        </div>
    </form>
</div>


<?php

// check if submit is set
if(isset($_POST['submit']))
{
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_price = $_POST['product_price'];
$category_id = $_POST['category_id'];
$valid_ext = array('jpeg', 'jpg', 'png');
$max_size = 1000000;
if(!isset($_FILES['product_image']) || $_FILES['product_image']['error'] == 4){
    $file_name = "";
} else {
    if ($_FILES['product_image']['size'] > $max_size) {
        throw new Exception('File size is too big');
    }
    $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) {
        throw new Exception('Invalid file extension');
    }
    $file_name = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 12)), 0, 12).'.'.$ext;

    if (!move_uploaded_file($_FILES['product_image']['tmp_name'], 'imgFood/'.$file_name)) {
        throw new Exception('Error while uploading file');
    }
}

if($file_name == ""){
    // update database without image
    $stmt = $conn->prepare("UPDATE product SET product_name = :product_name, product_description = :product_description, product_price = :product_price, category_id = :category_id WHERE id = :id");
    $stmt->execute([':product_name' => $product_name, ':product_description' => $product_description, ':product_price' => $product_price, ':category_id' => $category_id, ':id' => $id]);

    if ($stmt) {
        $_SESSION['update'] = "<div class='alert alert-success'>Product updated successfully.</div>";
        header("location: manage-product.php");
    }
} else {
    // update database
    $stmt = $conn->prepare("UPDATE product SET product_name = :product_name, product_description = :product_description, product_price = :product_price, category_id = :category_id, product_image = :product_image WHERE id = :id");
    $stmt->execute([':product_name' => $product_name, ':product_description' => $product_description, ':product_price' => $product_price, ':category_id' => $category_id, ':product_image' => $file_name, ':id' => $id]);

    if ($stmt) {
        $_SESSION['update'] = "<div class='alert alert-success'>Product updated successfully.</div>";
        header("location: manage-product.php");
    }
}
}

?>
