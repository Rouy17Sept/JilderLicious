
<?php include_once('partials/menu.php'); ?>

<!--TABLE to Show all users if role of user =1 (admin) -->

<?php 


    // When user role is 1 show all the users
    if($_SESSION['user_role'] == 1) {
?>

<div class="container">
    <div class="form-group">
        <h1>Manage Admin</h1>
        <a href="admin/add-user.php"><button type="button" class="btn btn-success">Add User</button></a>
        <?php 
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <table class="table table-striped">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                $stmt = $conn->prepare("SELECT * FROM user");
                $stmt->execute();
                $res = $stmt->fetchAll();
                $count = $stmt->rowCount();
                $sn = 1;
                if($count > 0) {
                    foreach($res as $row) {
                        $id = $row['id'];
                        $fullname = $row['fullname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        if ($row['role'] == 1) {
                            $role = "Admin";
                        } elseif ($row['role'] == 2) {
                            $role = "Operator";
                        }
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $role; ?></td>
                            <td>
                                <a href="admin/update-user.php?id=<?php echo $id; ?>" class="btn btn-primary">Update User</a>
                                <a href="admin/delete-user.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete User</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='error'>No User Added Yet.</td></tr>";
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?>

        </table>
    </div>
</div>
<?php 
    // When user role is 2 only show the details of the user
    } elseif ($_SESSION['user_role'] == 2) {
        ?>
        <div class="container">
    <div class="form-group">
        <h1>Manage User</h1>
        <?php 
            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <table class="table table-striped">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                $stmt = $conn->prepare("SELECT * FROM user WHERE id = {$_SESSION['user_id']}");
                $stmt->execute();
                $res = $stmt->fetchAll();
                $count = $stmt->rowCount();
                $sn = 1;
                if($count > 0) {
                    foreach($res as $row) {
                        $id = $row['id'];
                        $fullname = $row['fullname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        if ($row['role'] == 1) {
                            $role = "Admin";
                        } elseif ($row['role'] == 2) {
                            $role = "Operator";
                        }
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $role; ?></td>
                            <td>
                                <a href="admin/update-user.php?id=<?php echo $id; ?>" class="btn btn-primary">Update User</a>
                                <a href="admin/delete-user.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete User</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='error'>No User Added Yet.</td></tr>";
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?>

        </table>
    </div>
</div>
        <?php
    }