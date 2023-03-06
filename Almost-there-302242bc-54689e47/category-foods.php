<?php include_once('partials/menu.php'); ?>
<main> <!-- main content. This line will make the footer stay at the bottom of the page even if the content does not reacht the bottom -->
<body class="background-gradient">
    <div class="container mt-5">
        <h1 class="text-center mb-5">Foods</h1>
        <div class="row">
            <?php
            $category_id = $_GET['category_id'];
            $stmt = $conn->prepare("SELECT * FROM product WHERE category_id=:category_id AND active='Yes'");
            $stmt->execute(array(':category_id' => $category_id));
            $res = $stmt->fetchAll();
            $count = $stmt->rowCount();
            if ($count > 0) {
                foreach ($res as $row) {
                    $id = $row['id'];
                    $product_name = $row['product_name'];
                    $product_description = $row['product_description'];
                    $product_price = $row['product_price'];
                    $product_image = $row['product_image'];
            ?>
                    <div class="col">
                        <div class="card h-100">
                        <?php
                        if ($product_image == "") {
                            echo "<img src='img/default.jpg' class='card-img-top' alt='product_image'>";
                        } else {
                        ?>
                            <img src="admin/imgFood/<?php echo $product_image; ?>" class="card-img-top" alt='product_image'>
                        <?php
                        }
                        ?>
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="card-title text-center"><?php echo $product_name; ?></h5>
                                <p class="card-text text-center"><?php echo $product_description; ?></p>
                                <p class="text-center">Price: € <?php echo $product_price; ?></p>
                                <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary" onclick="addToCart(<?php echo $id; ?>)">Add to Cart</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>Product not added.</div>";
            }
            ?>
        </div>
    </div>
</body>
</main>
<?php include_once('partials/footer.php'); ?>	