<?php
include "includes/header.php";
require 'config.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$total = 0;
$cartProducts = '';
$products = [];

$query = $pdo->query("SELECT CONCAT(qty, ' * ', name, '\'s') AS product_with_qty, total FROM carts");

while ($row = $query->fetch()) {
    $total += $row['total'];
    $products[] = $row['product_with_qty'];
}
$cartProducts = implode(', ', $products);

?>

<div class="container" id="message">
    <h4 class="text-center my-4">Your cart!</h4>
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>
                    <a href="remove_from_cart.php?empty" onclick="return confirm('Are you sure you want to remove all items in your cart?');">Remove all from cart</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $pdo->query("SELECT * FROM carts");
            $total = 0;
            while ($row = $query->fetch()) :
            ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <input type="hidden" class="id" value="<?= $row['id'] ?>">
                    <td><img src="<?= $row['image'] ?>" width="50"></td>
                    <td><?= $row['name'] ?></td>
                    <td>
                        <?= $row['price'] ?> DH
                    </td>
                    <input type="hidden" class="price" value="<?= $row['price'] ?>">
                    <td>
                        <input type="number" class="form-control qty" value="<?= $row['qty'] ?>" style="width:75px;">
                    </td>
                    <td><?= $row['total'] ?> DH</td>
                    <td>
                        <a href="remove_from_cart.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure you want to remove this product?');">
                            <i class="icon-trash"></i> </a>
                    </td>
                </tr>
                <?php $total += $row['total']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="5"><b>Total</b></td>
                <td><b><?= $total ?> DH</b></td>
            </tr>
        </tbody>
    </table>


    <div class="w-50 m-auto">
        <div class="mt-4 text-center">
            <h3>Order</h3>
        </div>
        <form method="POST" id="checkout">
            <input type="hidden" id="products" value="<?= $cartProducts; ?>">
            <input type="hidden" id="total" value="<?= $total; ?>">
            <div class="form-group mt-3">
                Your Full Name
                <input type="text" id="name" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                Your Phone
                <input type="tel" id="phone" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                Your Full Address
                <input type="tel" id="address" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <input type="submit" id="submit" value="Complete your order!" class="btn btn-primary w-100">
            </div>
        </form>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>

<script src="./js/main.js"></script>
</body>

</html>