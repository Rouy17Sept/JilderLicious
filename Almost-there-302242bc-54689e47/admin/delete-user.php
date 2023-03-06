<?php include_once('partials/menu.php'); 

//Get the id of the user to be deleted
$user_id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM user WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>User Deleted Successfully</div>";
    header('location:admin/manage-user.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

