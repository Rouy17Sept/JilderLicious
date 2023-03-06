<?php include_once('partials/menu.php'); ?>


<!-- preloader 

<div id="preloader">
  <img src="img/jilderlicious-low-resolution-color-logo.png" alt="Preloader">
</div>

-->

<div class="container mt-5">
    <h1 class="text-center mb-5">Categories</h1>
    <div class="row">
        <?php
        $stmt = $conn->prepare("SELECT * FROM category WHERE active='Yes' ORDER BY RAND() LIMIT 4");
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
                    <img src="<?php 
                        if ($row['category_image'] == NULL) {
                            echo "img/default.jpg";
                        } else {
                            echo "admin/imgCategory/".$category_image;
                        } ?>" 
                        class="card-img-top" alt="category_image"
                        >
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title text-center"><?php echo $category_name; ?></h5>
                            <a href="category-foods.php?category_id=<?php echo $id; ?>" class="btn btn-primary mt-auto">See Foods</a>
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


<div class="container mt-5">
    <h1 class="text-center mb-5">Products</h1>
    <div class="row">
        <?php
        $stmt = $conn->prepare("SELECT * FROM product WHERE active='Yes' ORDER BY RAND() LIMIT 4");
        $stmt->execute();
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
                        <img src="<?php 
                        if ($row['product_image'] == NULL) {
                            echo "img/default.jpg";
                        } else {
                            echo "admin/imgFood/".$product_image;
                        } ?>" 
                        class="card-img-top" alt="product_image"
                        >
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title text-center"><?php echo $product_name; ?></h5>                        
                        <p class="card-text text-center"><?php echo $product_description; ?></p>                        
                        <p class="card-text text-center">€ <?php echo $product_price; ?></p>                        
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary" onclick="addToCart(<?php echo $id; ?>)">Order Now</a>
</div>
</div>
</div>

<?php
        }
    } else {
        echo "<div class='error'>Food not added.</div>";
    }
?>
</div>
</div>



    <?php include_once('partials/footer.php'); ?>