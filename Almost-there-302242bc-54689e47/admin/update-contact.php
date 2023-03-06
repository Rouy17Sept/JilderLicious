
<?php include_once('partials/menu.php'); ?>

<?php 

try {
    $stmt = $conn->prepare("SELECT * FROM contact WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $contact = $stmt->fetch();
    $id = $contact['id'];
    $name = $contact['name'];
    $email = $contact['email'];
    $phone = $contact['phone'];
    $ordernr = $contact['ordernr'];
    $message = $contact['message'];
    $created_at = $contact['created_at'];
    $updated_at = $contact['updated_at'];
    $ip = $contact['ip'];
    $status = $contact['status'];
    $last_updated_by = $contact['last_updated_by'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!-- Form to view and edit contactform. -->

<?php 

if ($last_updated_by == "") {
    $last_updated_by = "Not edited yet";
} else {
    $last_updated_by = $last_updated_by;
}

?>

<div class="container">
    <div class="form-group">
        <h1>Edit contact form of: <?php echo $name; ?></h1>
        <br><br>

        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
            </div>
            <div class="form-group">
                <label for="ordernr">Order number</label>
                <input type="text" name="ordernr" id="ordernr" class="form-control" value="<?php echo $ordernr; ?>">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5"><?php echo $message; ?></textarea>
            </div>
            <div class="form-group">
                <label for="created_at">Created at</label>
                <input type="text" name="created_at" id="created_at" class="form-control" value="<?php echo $created_at; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="updated_at">Updated at</label>
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="<?php echo $updated_at; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="last_updated_by">Last updated by</label>
                <input type="text" name="last_updated_by" id="last_updated_by" class="form-control" value="<?php echo $last_updated_by; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="ip">IP Customer</label>
                <input type="text" name="ip" id="ip" class="form-control" value="<?php echo $ip; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="new" <?php if ($status == "new") { echo "selected"; } ?>>New</option>
                    <option value="in progress" <?php if ($status == "in progress") { echo "selected"; } ?>>In progress</option>
                    <option value="waiting for customer" <?php if ($status == "waiting for customer") { echo "selected"; } ?>>Waiting for customer</option>
                    <option value="successfull" <?php if ($status == "successfull") { echo "selected"; } ?>>Successfull</option>
                    <option value="cancelled" <?php if ($status == "cancelled") { echo "selected"; } ?>>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>



<?php 

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ordernr = $_POST['ordernr'];
    $message = $_POST['message'];
    $updated_at = date("Y-m-d H:i:s");
    $status = $_POST['status'];
    $last_updated_by = $_SESSION['username'];

    try {
        $stmt = $conn->prepare("UPDATE contact SET name = :name, email = :email, phone = :phone, ordernr = :ordernr, message = :message, updated_at = :updated_at, status = :status, last_updated_by = :last_updated_by WHERE id = :id");
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'ordernr' => $ordernr, 'message' => $message, 'updated_at' => $updated_at, 'status' => $status, 'last_updated_by' => $last_updated_by, 'id' => $id]);
        $_SESSION['update'] = "<div class='alert alert-success' role='alert'>Contact form updated successfully</div>";
        header("location:admin/manage-contact.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>


