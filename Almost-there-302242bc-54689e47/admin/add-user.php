<?php include_once('partials/menu.php'); ?>

<!-- form to add user -->

<div class="container">
    <div class="form-group">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <div class="form-group">
                <tr>
                    <td>Full Name: *</td>
                    <td>
                        <input type="text" class="form-control" name="fullname" placeholder="Your Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Username: *</td>
                    <td>
                        <input type="text" name="username" class="form-control" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: *</td>
                    <td>
                        <input type="password"  name="password" class="form-control" placeholder="Your Password" required>
                    </td>
                </tr>

                <tr>
                    <td>Email: *</td>
                    <td>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </td>
                </tr>

                <tr>
                    <td>Role: *</td>
                    <td>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                            </select>    
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
                    </td>
                </tr>

            </div>

        </form>

    </div>

    <!-- text field to alert user that something may not be as intended. -->
    <?php if (!isset($_SESSION['user_role'])): ?>
        <div class="alert alert-danger">
            <strong>Session role is not set!</strong>
        <p class="note">PLEASE NOTE! Your Session role is not set. This could mean 1 of 3 things.
        <br><br>1. You have commented out the code in login_check.php and are trying to add a user before using this wonderful website.
        <br>If this is true, don't forget to uncomment it when you have finished to add a user. Also Thanks for using my code.
        <br><br>2. You have commented out the code in login_check.php and forgot to uncomment it.
        <br><br><strong>3. You have found a bug in the code. Please report it to the developer.
        <br>If this is the case, please report it to me: Youri Jilderda<a href="mailto:info@yjilderda.nl"> (info@yjilderda.nl)</a> or  <a href="https://yjilderda.nl">contact me at my website<a></strong>
        </p>
    <?php endif; ?>
        </div>
</div>

<?php 

if (isset($_POST['submit'])) {
    try {
        //check if username already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $username = $_POST['username'];
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "Username already exists, please choose a different one.";
            die();
        }
        //if username does not already exist, insert new user
        $stmt = $conn->prepare("INSERT INTO user (fullname, username, password, email, role) 
        VALUES (:fullname, :username, :password, :email, :role)");
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $role = $_POST['role'];
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['add'] = "<div class='alert alert-success' role='alert'>User added successfully</div>";
            header("location:admin/manage-user.php");
            exit();
            ob_end_flush();
        } else {
            $_SESSION['add'] = "<div class='alert alert-danger' alert='alert'>Failed to Add Admin.</div>";
            header("location:admin/add-user.php");
        }
    } catch (PDOException $e) {
        echo "Error Creating New User: " . $e->getMessage();
    }
}