<?php
session_start();
require 'config.php';

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $qty = $_POST['qty'];
        $user_id = $_SESSION['user_id'];
        $total = $price * $qty;
        $query = $pdo->prepare("SELECT product_id FROM carts WHERE product_id=?");
        $query->execute([$id]);
        $res = $query->fetch();

        $product_id = $res['product_id']  ?? false;

        if (!$product_id) {
            $sql = "INSERT INTO carts (name,price,image,qty,total,product_id,user_id) VALUES (?,?,?,?,?,?,?)";
            $pdo->prepare($sql)->execute([$name, $price, $image, $qty, $total, $id, $user_id]);

            echo '<div class="mt-3 alert alert-success alert-dismissible fade show"  role="alert">
                   Item has been added to your cart
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            echo '<div class="mt-3 alert alert-danger alert-dismissible fade show"  role="alert">
                        Item is already on your cart
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }
} else {

    echo '<div class="mt-3 alert alert-danger alert-dismissible fade show"  role="alert">
    Please login to add to your cart
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
