
<?php include_once('partials/menu.php'); ?>

<!-- Display Session messages -->

    <?php
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>

<!-- Table to see all categories and possibly edit/delete -->

<div class="container">
    <div class="form-group">
        <h1>Manage category</h1>
        <a href="admin/add-category.php"><button type="button" class="btn btn-success">Add category</button></a>
        
        <table class="table table-striped">
            <tr>
                <th>S.N.</th>
                <th>Category Name</th>
                <th>Image</th>
                <th>Active</th>
                <th>Favorite</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                $stmt = $conn->prepare("SELECT * FROM category");
                $stmt->execute();
                $res = $stmt->fetchAll();
                $count = $stmt->rowCount();
                $sn = 1;
                if ($count > 0) {
                    foreach ($res as $row) {
                        $id = $row['id'];
                        $category_name = $row['category_name'];
                        $category_image = $row['category_image'];
                        $active = $row['active'];
                        $favorite = $row['favorite'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $category_name; ?></td>
                            <td>
                                <?php
                                if ($category_image != "") {
                                    ?>
                                    <img src="imgCategory/<?php echo $category_image; ?>" width="125px">
                                    <?php
                                } else {
                                    echo "<div class='alert alert-danger'>Image not added.</div>";
                                }
                                ?>
                            <td><?php echo $active; ?></td>
                            <td><?php echo $favorite; ?></td>
                            <td>
                                <a href="admin/update-category.php?id=<?php echo $id; ?>" class="btn btn-primary">Update</a>
                                <a href="admin/delete-category.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6"><div class="alert alert-danger">No category added yet.</div></td>
                    </tr>
                    <?php
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }


            ?>
    </div>
</div>

