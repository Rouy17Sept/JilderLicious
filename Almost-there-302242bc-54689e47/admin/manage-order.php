
<?php include_once('partials/menu.php'); ?>

<!-- Show a session message once -->

<div class="container">

    <?php
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
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

            // Get filter of the order status
        if (isset($_GET['order_status'])) {
            $order_status = $_GET['order_status'];
        } else {
            $order_status = "";
        }

    ?>

</div>

<div class="container-fluid">
    <div class="form-group">
        <h1>Manage Orders</h1>
        <!--
        <a href="<?php //echo SITEURL; ?>admin/add-order.php"><button type="button" class="btn btn-success">Add Order</button></a>
        -->
    <table class="table table-striped">
        <tr>
            <th>S.N.</th>
            <th>Ordernr.</th>
            <th>Products</th>
            <th>Total</th>
            <th>
                <form action="" method="GET" class="d-flex justify-content-between">
                    <select name="order_status" id="order_status" class="col form-control">
                        <option value="" <?php if ($order_status == "") { echo "selected"; } ?>>Status</option>
                        <option value="new" <?php if ($order_status == "new") { echo "selected"; } ?>>New</option>
                        <option value="in progress" <?php if($order_status == 'in progress') { echo 'selected'; } ?>>In Progress</option>
                        <option value="shipped" <?php if($order_status == 'shipped') { echo 'selected'; } ?>>Shipped</option>
                        <option value="completed" <?php if($order_status == 'completed') { echo 'selected'; } ?>>Completed</option>
                        <option value="cancelled" <?php if($order_status == 'cancelled') { echo 'selected'; } ?>>Cancelled</option>
                    </select>
                    <input type="submit" name="submit" value="Filter" class="col btn btn-primary">
                    </div>
                    <!-- btn to clear the filter -->
                    <a href="admin/manage-order.php" class="col btn btn-primary">Clear Filter</a>
                </form>
            </th>
            <th>Name</th>
            <th>Postcode</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
    <?php

    $ordernrs = array();
    try {
        if ($order_status == "") {
            $stmt = $conn->prepare("SELECT * FROM tbl_order");
        } else { $stmt = $conn->prepare("SELECT * FROM tbl_order WHERE status = '$order_status'");
        }        
        $stmt->execute();
        $res = $stmt->fetchAll();
        $count = $stmt->rowCount();
        $sn = 1;
        if ($count > 0) {
            foreach ($res as $row) {
                if(!in_array($row['ordernr'], $ordernrs)) {
                    array_push($ordernrs, $row['ordernr']);
                    $id = $row['id'];
                    $ordernr = $row['ordernr'];

                    // count how many products are in the order
                    if ($order_status == "") {
                        $stmt2 = $conn->prepare("SELECT * FROM tbl_order WHERE ordernr = $ordernr");
                    } else {
                        $stmt2 = $conn->prepare("SELECT * FROM tbl_order WHERE ordernr = $ordernr AND status = '$order_status'");
                    }
                    $stmt2->execute();
                    $res2 = $stmt2->fetchAll();
                    $count2 = $stmt2->rowCount();
                    $products = $count2;

                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $total = $row['total'];
                    $user_id = $row['user_id'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_phone = $row['customer_phone'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $customer_postcode = $row['customer_postcode'];
                    $customer_city = $row['customer_city'];
                    $ip_address = $row['ip_address'];
                    $payment_method = $row['payment_method'];
                    $payment_status = $row['payment_status'];
                    $created_at = date("D d-m-Y H:i:s", strtotime($row['created_at']));
                    $updated_at = date("D d-m-Y H:i:s", strtotime($row['updated_at']));
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $ordernr; ?></td>
                        <td><?php echo $products; ?></td>
                        <td>€ <?php echo $total; ?></td>
                        <td class="text-center text-capitalize">
                            <?php 
                            if ($status == "new" || $status == "0") {
                                echo "<label style='color: blue;'>$status</label>";
                            } elseif ($status == "in progress" || $status == "1") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "shipped" || $status == "2") {
                                echo "<label style='color: yellow;'>$status</label>";
                            } elseif ($status == "completed" || $status == "3") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "cancelled" || $status == "4") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_postcode; ?></td>
                        <td><?php echo $created_at; ?></td>
                        <td><?php echo $updated_at; ?></td>
                        <td>
                            <a href="view-order.php?ordernr=<?php echo $ordernr; ?>" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                    <?php
                }
            }
        } else {
            echo "<tr><td colspan='12' class='text-center'>No orders found</td></tr>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    </table>
</div>
</div>
