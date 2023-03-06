<?php include_once('partials/menu.php'); ?>
<main> <!-- main content. This line will make the footer stay at the bottom of the page even if the content does not reach the bottom -->

    <div class="container mt-5">
        <h1 class="text-center mb-5">Categories</h1>
        <div class="row">
            <?php
            $stmt = $conn->prepare("SELECT * FROM category WHERE active='Yes'");
            $stmt->execute();
            $res = $stmt->fetchAll();
            $count = $stmt->rowCount();
            if ($count > 0) {
                foreach ($res as $row) {
                    $id = $row['id'];
                    $category_name = $row['category_name'];
                    $category_image = $row['category_image'];
            ?>
                    <div class="col">
                        <div class="card h-100">

                        <?php
                        if ($category_image == "") {
                            echo "<img src='img/default.jpg' class='card-img-top' alt='category_image'>";
                        } else {
                        ?>
                            <img src="admin/imgCategory/<?php echo $category_image; ?>" class="card-img-top" alt="category_image">
                        <?php
                        }
                        ?>
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $category_name; ?></h5>
                                <a href="category-foods.php?category_id=<?php echo $id; ?>" class="btn btn-primary">See Foods</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>Category not added.</div>";
            }
            ?>
        </div>
    </div>


</main>
<?php include_once('partials/footer.php'); ?>