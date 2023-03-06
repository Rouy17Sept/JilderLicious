<?php include_once('partials/menu.php'); ?>

<!-- Start of dashboard/main page -->
<div class="container">
<?php 
    if(isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
?>
</div>

<!-- Retrieve data from Database -->

<?php 

try {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_order WHERE status = 'New' OR status = '0' GROUP BY ordernr");
    $stmt->execute();
    $res = $stmt->fetchAll();
    $countOrderNew = $stmt->rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT COUNT(*) FROM tbl_order WHERE status = 'in progress' GROUP BY ordernr");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countOrderInProgress = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT COUNT(*) FROM tbl_order WHERE status = 'shipped' GROUP BY ordernr");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countOrderShipped = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT COUNT(*) FROM tbl_order WHERE status = 'completed' GROUP BY ordernr");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countOrderCompleted = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT COUNT(*) FROM tbl_order WHERE status = 'cancelled' GROUP BY ordernr");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countOrderCancelled = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT * FROM contact WHERE status = '0' OR status = 'New'");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countContactNew = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT * FROM contact WHERE status = 'in progress'");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countContactInProgress = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT * FROM contact WHERE status = 'waiting for customer'");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countContactWaitingForCustomer = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT * FROM contact WHERE status = 'successfull'");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countContactSuccessfull = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

try {
    $stmt = $conn -> prepare("SELECT * FROM contact WHERE status = 'cancelled'");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countContactCancelled = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}


try {
    $stmt = $conn -> prepare("SELECT * FROM tbl_order GROUP BY ordernr");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countAllOrder = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

// count all contact
try {
    $stmt = $conn -> prepare("SELECT * FROM contact");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countAllContact = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

// count all users
try {
    $stmt = $conn -> prepare("SELECT * FROM user");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countAllUser = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

// count all products
try {
    $stmt = $conn -> prepare("SELECT * FROM product");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countAllProduct = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}

// count all categories
try {
    $stmt = $conn -> prepare("SELECT * FROM category");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    $countAllCategory = $stmt -> rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e -> getMessage();
}



?>

<!-- Display all data we retrieved above -->


<div class="container">
<h3 class="text-center mt-5 text-primary">Dashboard</h3>
    <div class="row">
            <table class="table table-striped table-hover text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th><a href="manage-order.php" class="text-white">Order Status</a></th>
                        <th>Number of orders</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="manage-order.php?order_status=new">New</a></td>
                        <td><?php echo $countOrderNew ?></td>
                    </tr>
                    <tr>
                        <td><a href="manage-order.php?order_status=in progress">In Progress</s></td>
                        <td><?php echo $countOrderInProgress ?></td>
                    </tr>
                    <tr>
                        <td><a href="manage-order.php?order_status=shipped">Shipped</a></td>
                        <td><?php echo $countOrderShipped ?></td>
                    </tr>
                    <tr>
                        <td><a href="manage-order.php?order_status=completed">Completed</a></td>
                        <td><?php echo $countOrderCompleted ?></td>
                    </tr>
                    <tr>
                        <td><a href="manage-order.php?order_status=cancelled">Cancelled</a></td>
                        <td><?php echo $countOrderCancelled ?></td>
                    </tr>
                </tbody>
                <thead class="bg-primary text-white">
                    <tr>
                        <th><a href="manage-contact.php" class="text-white">Contact Status</a></th>
                        <th>Number of contacts</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>New</td>
                        <td><?php echo $countContactNew ?></td>
                    </tr>
                    <tr>
                        <td>In progress</td>
                        <td><?php echo $countContactInProgress ?></td>
                    </tr>
                    <tr>
                        <td>Waiting for Customer</td>
                        <td><?php echo $countContactWaitingForCustomer ?></td>
                    </tr>
                    <tr>
                        <td>Successfull</td>
                        <td><?php echo $countContactSuccessfull ?></td>
                    </tr>
                    <tr>
                        <td>Cancelled</td>
                        <td><?php echo $countContactCancelled ?></td>
                    </tr>
                </tbody>

                <thead class="bg-primary text-white">
                    <tr>
                        <th>Total</th>
                        <th>Number of</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Orders</td>
                        <td><?php echo $countAllOrder ?></td>
                    </tr>
                    <tr>
                        <td>Contacts</td>
                        <td><?php echo $countAllContact ?></td>
                    </tr>
                    <tr>
                        <td>Users</td>
                        <td><?php echo $countAllUser ?></td>
                    </tr>
                    <tr>
                        <td>Products</td>
                        <td><?php echo $countAllProduct ?></td>
                    </tr>
                    <tr>
                        <td>Categories</td>
                        <td><?php echo $countAllCategory ?></td>
                    </tr>
                </tbody>
            </table>
        </div>