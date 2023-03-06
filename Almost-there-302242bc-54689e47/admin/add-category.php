
<?php include_once('partials/menu.php'); ?>

<!-- Form to add category  -->

<div class="container">
    <div class="form-group">
        <h1>Add Category</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <tr>
                    <td>Title: *</td>
                    <td>
                        <input type="text" class="form-control" name="category_name" placeholder="Category Name" required>
                    </td>
                </tr>
                <div class="form-group">
                    <label for="category_image">Product Image</label>
                    <input type="file" class="form-control" id="category_image" name="category_image">
                </div>
                <div class="form-check">
                <tr>
                    <td>Active: *</td>
                    <div class="form-check">
                    <td>
                        <input type="radio" name="active" value="YES"> YES
                        <input type="radio" name="active" value="NO"> NO
                    </td>
                </tr>
                </div>
                <tr> 
                    <td>Favorite: *</td>
                    <div class="form-check">
                    <td>
                        <input type="radio" name="favorite" value="YES"> YES
                        <input type="radio" name="favorite" value="NO"> NO
                    </td>
                </tr>
                </div>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                    </td>
                </tr>
            </div>
        </form>

    </div>
</div>

<?php

$max_size = 5242880;
$valid_ext = array('jpg', 'jpeg', 'png', 'gif');
$path = 'imgCategory/';

if (isset($_POST['submit'])) {
    try {
        if (!isset($_FILES['category_image']) || $_FILES['category_image']['error'] == 4) {
            $file_name = '';
        } else {
            if ($_FILES['cataegory_image']['size'] > $max_size) {
                throw new Exception('File size is exceeding maximum allowed size.');
            }
            $ext = strtolower(pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $valid_ext)) {
                throw new Exception('Invalid file extension.');
            }
            $file_name = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 12)), 0, 12) . '.' . $ext;

            if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $path . $file_name)) {
                throw new Exception('Error uploading file - check destination is writeable.');
            }
        }

        $stmt = $conn->prepare("INSERT INTO category (category_name, category_image, active, favorite)
        VALUES (:category_name, :category_image, :active, :favorite)");
        $stmt -> bindParam(':category_name', $category_name);
        $stmt -> bindParam(':category_image', $category_image);
        $stmt -> bindParam(':active', $active);
        $stmt -> bindParam(':favorite', $favorite);
        $category_name = $_POST['category_name'];
        $category_image = $file_name;
        $active = $_POST['active'];
        $favorite = $_POST['favorite'];
        $stmt -> execute();
        $result = $stmt->fetchAll();

        if ($stmt == true) {
            $_SESSION['add'] = "<div class='alert alert-success' role='alert'>Category Added Successfully.</div>";
            header('location:admin/manage-category.php');
        } else {
            $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>Failed to Add Category.</div>";
            header('location:admin/manage-category.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>