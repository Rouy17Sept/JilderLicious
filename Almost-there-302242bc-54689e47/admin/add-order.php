<!-- in een verder uitgewerkt stadium kan je hier in de admin pagina als admin of operator een order toevoegen -->
<?php include_once('partials/menu.php'); ?>
<div class="container">
    <div class="form-group">
        <h1>Add Order</h1>

        <form action="" method="post" autocomplete="on">
                <div class="form-group">
                    <tr>
                        <td>Product: *</td>
                        <td>
                            <select name="" id="" class="form-control" >
                                
                            <?php

                            $stmtFood = $conn->prepare("SELECT product_name FROM product WHERE active='YES'");
                            $stmtFood->execute();
                            $resultFood = $stmtFood->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultFood as $row) {
                                $product_name = $row['product_name'];
                                ?>

                                <option value="<?php echo $product_name; ?>"><?php echo $product_name; ?></option>

                                <?php
                            }

                            ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: *</td>
                        <td>
                            <input type="number" class="form-control" name="price" step="0.00" placeholder="Price" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty: *</td>
                        <td>
                            <input type="number" class="form-control" name="qty" step="1" placeholder="Qty" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Total: *</td>
                        <td>
                            <input type="text" class="form-control" name="total" placeholder="Total" required>
                        </td>
                    </tr>
                    <tr>
                        <td>USER ID: *</td>
                        <td>
                            <input type="number" class="form-control" name="user_id" step="1" placeholder=" <?php echo $_SESSION['user_id']; ?> " readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Name: *</td>
                        <td>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Email: *</td>
                        <td>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone: *</td>
                        <td>
                            <input type="phone" class="form-control" name="phone" placeholder="Phone" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Address: *</td>
                        <td>
                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Postcode: *</td>
                        <td>
                            <input type="text" class="form-control" name="postcode" placeholder="Postcode" required>
                        </td>
                    </tr>
                    <tr>
                        <td>City: *</td>
                        <td>
                            <input type="text" class="form-control" name="city" placeholder="City" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Methode: *</td>
                        <td>
                            <select name="payment_methode" id="" class="form-control">
                                <option value="">Choose Payment Methode</option>
                                <option value="cash">Cash</option>
                                <option value="ideal">IDEAL</option>
                                <option value="paypal">Paypal</option>
                            </select>
                        </td>
                    </tr>

                </div>

        </form>
    </div>
</div>