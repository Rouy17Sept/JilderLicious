<?php include_once('partials/menu.php'); 

    if (!isset($_GET['ordernr'])) {
        $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>No ID set</div>";
        header('location:admin/manage-order.php');
    } else {
        $ordernr = $_GET['ordernr'];
    }

    ?>

    <!-- Show a session message once -->
    <div class="container">
        <?php
            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
    </div>

    <div class="container">
        <div class="form-group">
    <h2>Order Details</h2>
    <form action="" method="POST" class="order-form" >
    <table>
    <div class="form-group">
        <label for="ordernr">Order Number</label>
        <input type="text" name="ordernr" id="ordernr" class="form-control text-center" value="<?php echo $ordernr; ?>" readonly>
    </div>
    
    <?php   
        try {
            $stmt = $conn->prepare("SELECT * FROM tbl_order WHERE ordernr = $ordernr");
            $stmt->execute();
            $res = $stmt->fetchAll();
            if ($stmt->rowCount() > 0) {
                foreach ($res as $row) {
                    $id = $row['id'];
                    $ordernr = $row['ordernr'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $product_id = $row['product_id'];

                    echo "
                        <div class='form-row'>
                        <div class='col'>
                        <input type='hidden' name='id' id='id' class='form-control' value='$id' readonly>
                        <label for='product_id'>Product ID</label>
                        <input type='text' name='product_id' id='product_id' class='form-control' value='$product_id' readonly>
                        </div>
                        <div class='col'>
                        <label for='food'>Food</label>
                        <input type='text' name='food' id='food' class='form-control' value='$food' readonly>
                        </div>
                        <div class='col'>
                        <label for='price'>Price per piece</label>
                        <input type='text' name='price' id='price' class='form-control' value='€ $price' readonly>
                        </div>
                        <div class='col'>
                        <label for='quantity'>Quantity</label>
                        <input type='number' name='quantity' id='quantity' class='form-control' step='1' value='$quantity' readonly>
                        </div>
                        </div>
                        ";                   
                }
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
                $created_at = $row['created_at'];
                $updated_at = $row['updated_at'];
                $last_updated_by = $row['last_updated_by'];
                $comment = $row['comment'];

                $created_at = date("d-m-Y H:i:s", strtotime($created_at));

                if ($updated_at == "") {
                    $updated_at = "Not updated yet";
                } else {
                    $updated_at = date("d-m-Y H:i:s", strtotime($updated_at));
                }

                if ($last_updated_by == "") {
                    $last_updated_by = "Nobody yet";
                } else {
                    $last_updated_by = $last_updated_by;
                }
                ?>
            <div class="form-group">
                <label for="total">Total Price:</label>
                <input type="text" name="total" id="total" class="form-control" value="€ <?php echo $total; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="customer_phone">Customer Phone</label>
                    <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="<?php echo $customer_phone; ?>" >
                </div>
                <div class="col">
                    <label for="customer_email">Customer Email</label>
                    <input type="text" name="customer_email" id="customer_email" class="form-control" value="<?php echo $customer_email; ?>" >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="customer_address">Customer Address</label>
                    <input type="text" name="customer_address" id="customer_address" class="form-control" value="<?php echo $customer_address; ?>" >
                </div>
                <div class="col">
                    <label for="customer_postcode">Customer Postcode</label>
                    <input type="text" name="customer_postcode" id="customer_postcode" class="form-control" value="<?php echo $customer_postcode; ?>" >
                </div>
                <div class="col">
                    <label for="customer_city">Customer City</label>
                    <input type="text" name="customer_city" id="customer_city" class="form-control" value="<?php echo $customer_city; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="3"><?php echo $comment; ?></textarea>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control">
                        <option value="Cash" <?php if($payment_method == "Cash") { echo "selected"; } ?>>Cash</option>
                        <option value="Credit Card" <?php if($payment_method == "Credit Card") { echo "selected"; } ?>>Credit Card</option>
                        <option value="Paypal" <?php if($payment_method == "Paypal") { echo "selected"; } ?>>Paypal</option>
                    </select>
                </div>
                <div class="col">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="Pending" <?php if($payment_status == 'Pending') { echo 'selected'; } ?>>Pending</option>
                        <option value="Processing" <?php if($payment_status == 'Processing') { echo 'selected'; } ?>>Processing</option>
                        <option value="Completed" <?php if($payment_status == 'Completed') { echo 'selected'; } ?>>Completed</option>
                        <option value="Cancelled" <?php if($payment_status == 'Cancelled') { echo 'selected'; } ?>>Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="created_at">Created At</label>
                    <input type="text" name="created_at" id="created_at" class="form-control" value="<?php echo $created_at; ?>" readonly>
                </div>
                <div class="col">
                    <label for="updated_at">Updated At</label>
                    <input type="text" name="updated_at" id="updated_at" class="form-control" value="<?php echo $updated_at; ?>" readonly>
                </div>
                <div class="col">
                    <label for="last_updated_by">Last Updated By</label>
                    <input type="text" name="last_updated_by" id="last_updated_by" class="form-control" value="<?php echo $last_updated_by; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="new" <?php if($status == 'new') { echo 'selected'; } ?>>New</option>
                        <option value="in progress" <?php if($status == 'in progress') { echo 'selected'; } ?>>In Progress</option>
                        <option value="shipped" <?php if($status == 'shipped') { echo 'selected'; } ?>>Shipped</option>
                        <option value="completed" <?php if($status == 'completed') { echo 'selected'; } ?>>Completed</option>
                        <option value="cancelled" <?php if($status == 'cancelled') { echo 'selected'; } ?>>Cancelled</option>
                    </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update Order" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

 <?php
            } else {
                $_SESSION['delete'] = "<div class='alert alert-danger' alert='alert'>No ID set</div>";
                header('location:admin/manage-order.php');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

    <?php if (isset($_POST['submit'])) {
        $ordernr = $_POST['ordernr'];
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];
        $customer_postcode = $_POST['customer_postcode'];
        $customer_city = $_POST['customer_city'];
        $payment_method = $_POST['payment_method'];
        $payment_status = $_POST['payment_status'];
        $status = $_POST['status'];
        $updated_at = date("Y-m-d H:i:s");
        $comment = $_POST['comment'];
        $last_updated_by = $_SESSION['username'];

        try {
            $sql = "UPDATE tbl_order SET
                customer_name = :customer_name,
                customer_phone = :customer_phone,
                customer_email = :customer_email,
                customer_address = :customer_address,
                customer_postcode = :customer_postcode,
                customer_city = :customer_city,
                payment_method = :payment_method,
                payment_status = :payment_status,
                status = :status,
                comment = :comment,
                updated_at = :updated_at,
                last_updated_by = :last_updated_by
                WHERE ordernr = $_POST[ordernr]
            ";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':customer_name', $customer_name);
            $stmt->bindParam(':customer_phone', $customer_phone);
            $stmt->bindParam(':customer_email', $customer_email);
            $stmt->bindParam(':customer_address', $customer_address);
            $stmt->bindParam(':customer_postcode', $customer_postcode);
            $stmt->bindParam(':customer_city', $customer_city);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':payment_status', $payment_status);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':updated_at', $updated_at);
            $stmt->bindParam(':last_updated_by', $last_updated_by);

            $stmt->execute();

            if ($stmt == true) {
                $_SESSION['update'] = "<div class='alert alert-success' alert='alert'>Order ". $ordernr . " Updated Successfully</div>";
                // Refresh to show updated data. Did not choose to redirect to view-order.php because you would lose sight of the order you just updated.
                header('location:admin/view-order.php?ordernr='.$ordernr);
            } else {
                $_SESSION['update'] = "<div class='alert alert-danger' alert='alert'>Failed to Update Order</div>";
                header('location:admin/view-order.php?ordernr='.$ordernr);
    }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } ?>
