<?php
session_start();
require 'config.php';

$query = $pdo->query("SELECT * FROM carts");

$rows = $query->rowCount();

echo $rows;
