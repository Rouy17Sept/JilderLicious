
<?php include_once('partials/menu.php'); ?>

<?php

try {
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $user = $stmt->fetch();
    $id = $user['id'];
    $username = $user['username'];
    $fullname = $user['fullname'];
    $email = $user['email'];
    $role = $user['role'];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!-- Form to edit user details-->

<div class="container">
    <div class="form-group">
        <h1>EDIT <?php echo $username; ?></h1>
        <br><br>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $fullname; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
            </div>            
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="1" <?php if($role == 1) { echo "selected"; } ?>>Admin</option>
                    <option value="2" <?php if($role == 2) { echo "selected"; } ?>>Operator</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update User" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    try {
        $stmt = $conn->prepare("UPDATE user SET username = :username, fullname = :fullname, email = :email, role = :role WHERE id = :id");
        $stmt->execute(['username' => $username, 'fullname' => $fullname, 'email' => $email, 'role' => $role, 'id' => $id]);
        $_SESSION['update'] = "<div class='alert alert-success' role='alert'>User Updated Successfully</div>";
        header("location:admin/manage-user.php?id=$id");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>