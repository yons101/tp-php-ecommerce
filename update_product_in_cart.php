<?php
session_start();
require 'config.php';

if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $id = $_POST['id'];
    $price = $_POST['price'];

    $total = $qty * $price;
    $sql = "UPDATE carts SET qty=?, total=? WHERE id=?";
    $pdo->prepare($sql)->execute([$qty, $total, $id]);
}
