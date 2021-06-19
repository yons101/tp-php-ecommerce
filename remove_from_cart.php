<?php
session_start();
require 'config.php';

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $pdo->prepare("DELETE FROM carts WHERE id=?")->execute([$id]);

    header('location:cart.php');
}

if (isset($_GET['empty'])) {
    $pdo->prepare("DELETE FROM carts")->execute();
    header('location:cart.php');
}
