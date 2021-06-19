<?php
session_start();
require 'config.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$products = $_POST['products'];
$total = $_POST['total'];
$address = $_POST['address'];
$user_id = $_SESSION['user_id'];

$orderSuccessMessage = '';

$sql = "INSERT INTO orders (name,phone,address,products,total, user_id)VALUES(?,?,?,?,?,?)";
$pdo->prepare($sql)->execute([$name, $phone, $address, $products, $total, $user_id]);

$pdo->prepare("DELETE FROM carts")->execute();

$orderSuccessMessage .= '<div class="text-center mt-5">
								<h2 class="text-success">Your Order Has been Placed Successfully!</h2>
								<h4>You have bought : ' . $products . '</h4>
								<h4>For a total amount of : ' . $total . ' DH</h4>
						  </div>';
echo $orderSuccessMessage;
