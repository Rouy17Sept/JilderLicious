
<?php include_once('partials/menu.php'); ?>
<main> <!-- main content. This line will make the footer stay at the bottom of the page even if the content does not reach the bottom -->
<?php

if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
} else {
    echo '
    <div class="container mt-5">
        <h1 class="text-center mb-5">Contact Form</h1>
        <form action="" method="post">
            <div class="form-group text-white">
                <label for="name">Name: *</label>
                <input type="text" class="form-control" name="name" placeholder="Name" required>
            </div>
            <div class="form-group text-white">
                <label for="email">Email: *</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group text-white">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" name="phone" placeholder="Phone">
            </div>
            <div class="form-group text-white">
                <label for="ordernr">Ordernr.</label>
                <input type="text" class="form-control" name="ordernr" placeholder="Ordernr.">
            </div>
            <div class="form-group text-white">
                <label for="message">Message: *</label>
                <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Message" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
            </div>
        </form>
    </div>
';
}

?>

<?php
if (isset($_POST['submit'])) {
    $current_time = date('Y-m-d H:i:s');
    $st = "new";
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt = $conn->prepare("SELECT count(*) FROM contact WHERE ip = :ip AND created_at >= :time_24hrs_ago");
    $stmt->bindParam(':ip', $ip);
    $stmt->bindParam(':time_24hrs_ago', $time_24hrs_ago);
    $time_24hrs_ago = $current_time - (24 * 60 * 60); 
    $stmt->execute();
    $num_submissions = $stmt->fetchColumn();

    if ($num_submissions > 3) {
        $_SESSION['add'] = "
        <div class'container'>
        <div class='alert alert-danger center-block' role='alert'>
        <h4 class='alert-heading'>Too many submissions!</h4>
        <p>You have submitted the form too many times in the last 24 hours. Please try again later.</p>
        <hr>
        <p class='mb-0'>Have a nice day and come back tomorrow!!</p>
        </div>
        </div>";
        header('location: contact.php');
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, ordernr, message, ip, created_at, status) 
            VALUES (:name, :email, :phone, :ordernr, :message, :ip, :created_at, :st)");
            $stmt -> bindParam(':name', $name);
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':phone', $phone);
            $stmt -> bindParam(':ordernr', $ordernr);
            $stmt -> bindParam(':message', $message);
            $stmt -> bindParam(':ip', $ip);
            $stmt -> bindParam(':created_at', $current_time);
            $stmt -> bindParam(':st', $st);
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $ordernr = $_POST['ordernr'];
            $message = $_POST['message'];
            $stmt -> execute();
            $result = $stmt->fetchAll();
    
            if ($stmt -> rowCount() > 0) {
                $_SESSION['add'] = "
                <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Message sent successfully!</h4>
                <p>Thank you for contacting us. We will get back to you as soon as possible.</p>
                <hr>
                <p class='mb-0'>Have a nice day!</p>
                </div>
                ";
                header('location: contact.php');
            ob_end_flush();
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to send message.</div>";
            header('location: contact.php');
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
}


?>
</main>
<?php include_once('partials/footer.php'); ?>