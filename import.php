<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$content = file_get_contents('./products.json');
$initial_products = json_decode($content);

foreach ($initial_products as $product) {
    $name = $product->name;
    $price = $product->price;
    $image = $product->image;
    $category_id = $product->category_id;
    try {

        $sql = "INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`) VALUES(NULL, '$name', $price , '$image', $category_id)";
        $pdo->exec($sql);
        echo "New record created successfully";
    } catch (PDOException $e) {
        echo $sql . " " . $e->getMessage();
    }
}
echo "Done";
