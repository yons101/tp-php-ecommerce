<?php
session_start();
?>

<html>

<head>
    <title>Boutique</title>
    <link rel='stylesheet' href='https://bootswatch.com/5/lumen/bootstrap.min.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" />

</head>

<body class="">

    <nav class="px-5 navbar navbar-expand-md bg-dark navbar-dark d-flex justify-content-between">
        <a class="navbar-brand" href="index.php">Boutique</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="cart.php">
                    <i class="icon-basket"></i>
                    <span id="cart" class="badge badge-warning">
                    </span>
                </a>
            </li>

            <?php if (isset($_SESSION["username"])) :  ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        Logout
                    </a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        Login
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>