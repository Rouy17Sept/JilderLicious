
<?php include_once('partials/menu.php'); ?>

<!-- Hier start een table om alle producten te tonen -->

<div class="container">
    <div class="form-group">
        <h1>Manage Product</h1>
        <a href="admin/add-product.php"><button type="button" class="btn btn-success">Add Product</button></a>
        <?php 
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <table class="table table-striped">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                $stmt = $conn->prepare("SELECT * FROM product");
                $stmt->execute();
                $res = $stmt->fetchAll();
                $count = $stmt->rowCount();
                $sn = 1;
                if($count > 0) {
                    foreach($res as $row) {
                        $id = $row['id'];
                        $title = $row['product_name'];
                        $category = $row['category_id'];
                        $price = $row['product_price'];
                        $image_name = $row['product_image'];
                        $featured = $row['active'];
                        $active = $row['favorite'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php
                                    $stmt2 = $conn->prepare("SELECT * FROM category WHERE id = $category");
                                    $stmt2->execute();
                                    $res2 = $stmt2->fetchAll();
                                    $count2 = $stmt2->rowCount();
                                    if($count2 > 0) {
                                        foreach($res2 as $row2) {
                                            $category_title = $row2['category_name'];
                                            echo $category_title;
                                        }
                                    } else {
                                        echo "<div class='error'>Category not found.</div>";
                                    }
                                ?>
                            </td>
                            <td>€ <?php echo $price; ?></td>
                            <td>
                                <?php 
                                    if($image_name != "") {
                                        ?>
                                        <img src="imgFood/<?php echo $image_name; ?>" width="125px">
                                        <?php
                                    } else {
                                        echo "<div class='alert alert-danger'>Image not added.</div>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="admin/update-product.php?id=<?php echo $id; ?>" class="btn btn-primary">Update Product</a>
                                <a href="admin/delete-product.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Product</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7"><div class="alert alert-danger">No product added yet.</div></td>
                    </tr>
                    <?php
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
            ?>
</div>