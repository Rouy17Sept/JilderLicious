
<?php include_once('partials/menu.php'); ?>

<!-- Form to add product -->

<div class="container">
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>
</div>

<div class="container">
    <h1>Add product</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name">
    </div>
    <div class="form-group">
        <label for="product_description">Product Description</label>
        <input type="text" class="form-control" id="product_description" name="product_description">
    </div>
    <div class="form-group">
        <label for="product_price">Product Price</label>
        <div class="input-group-prepend">
        <span class="input-group-text">€</span>
        <input type="number" class="form-control" id="product_price" min="0.00" step="0.001" name="product_price">
        </div>        
    </div>
    <div class="form-group">
        <label for="product_image">Product Image</label>
        <input type="file" class="form-control" id="product_image" name="product_image">
    </div>
    <div class="form-group">
        <label for="active">Active: </label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="active" value="YES">
            <label class="form-check-label" for="active">YES</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="active" value="NO">
            <label class="form-check-label" for="active">NO</label>
        </div>
        <div class="form-group">
        <label for="favorite">Favorite: </label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="favorite" id="favorite" value="YES">
            <label class="form-check-label" for="favorite">YES</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="favorite" id="favorite" value="NO">
            <label class="form-check-label" for="favorite">NO</label>
        </div>        
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            <option value="">Select Category</option>

            <?php

            $stmt = $conn->prepare("SELECT id, category_name FROM category WHERE active='YES'");
            $stmt->execute();
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                foreach ($result as $row) {
                    $category_id = $row['id'];
                    $category_name = $row['category_name'];
                    ?>
                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
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
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php

    $max_size = 5242880;
    $valid_ext = array('jpg', 'jpeg', 'png', 'gif');


    if(isset($_POST['submit'])){
        try {
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

                $stmt2 = $conn->prepare("INSERT INTO product (product_name, product_description, product_price, product_image, active, favorite, category_id) 
                VALUES (:product_name, :product_description, :product_price, :product_image, :active, :favorite, :category_id)");
                $stmt2->bindParam(':product_name', $_POST['product_name']);
                $stmt2->bindParam(':product_description', $_POST['product_description']);
                $stmt2->bindParam(':product_price', $_POST['product_price']);
                $stmt2->bindParam(':product_image', $file_name);
                $stmt2->bindParam(':category_id', $_POST['category_id']);
                $stmt2->bindParam(':active', $_POST['active']);
                $stmt2->bindParam(':favorite', $_POST['favorite']);
                $stmt2->execute();
                $result2 = $stmt2->fetchAll();

                if ($stmt2->rowCount() > 0) {
                    $_SESSION['add'] = "<div class='alert alert-success'>Product added successfully</div>";
                    header('location:admin/manage-product.php');
                } else {
                    $_SESSION['add'] = "<div class='alert alert-danger'>Failed to add product</div>";
                    header('location:admin/add-product.php');
                }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?>