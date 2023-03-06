
<?php include_once('partials/menu.php'); ?>

<!-- Display session message once -->


    <?php
        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>

    <!-- Table to see all contactforms and their status.  -->


<div class="container">
    <div class="form-group">
        <h1>Manage contact</h1>
        <table class="table table-striped">
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Ordernr</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php

            try {
                $stmt = $conn->prepare("SELECT * FROM contact");
                $stmt->execute();
                $res = $stmt->fetchAll();
                $count = $stmt->rowCount();
                $sn = 1;
                if ($count > 0) {
                    foreach ($res as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $ordernr = $row['ordernr'];
                        $message = $row['message'];
                        $created_at = $row['created_at'];
                        $updated_at = $row['updated_at'];
                        $ip = $row['ip'];
                        $status = $row['status'];

                        if ($status == 0 ) {
                            $status = "New";
                        } elseif ($status == 1) {
                            $status = "In progress";
                        } elseif ($status == 2) {
                            $status = "Waiting for customer";
                        } elseif ($status == 3) {
                            $status = "Successfull";
                        } elseif ($status == 4) {
                            $status = "Cancelled";
                        }
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $ordernr; ?></td>
                            <td><?php echo $created_at; ?></td>
                            <td><?php echo $updated_at; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <a href="admin/update-contact.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-primary">VIEW</button></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No contact found</td></tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </table>

    </div>
</div>