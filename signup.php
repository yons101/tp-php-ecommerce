<?php
include "includes/header.php";
if (isset($_SESSION["username"])) {
    header("Location: index.php");
}

?>
<html>

<head>
    <title>Sign Up</title>
</head>

<body>
    <?php
    require('config.php');
    if (isset($_REQUEST['username'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $sql = "INSERT into `users` (id, username, password) VALUES (NULL, ?,?)";
        $result = $pdo->prepare($sql)->execute([$username, md5($password)]);

        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE username=? and password=?");
        $stmt->execute([$username, md5($password)]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }
    } else {
    ?>
        <div class="container d-flex justify-content-center ">
            <form class="w-75 mt-5" method="post" name="login">
                <h1 class="text-center">Sign Up</h1>
                <label>Username</label>
                <input name="username" type="text" class="my-3 form-control" placeholder="Username" required autofocus />
                <label>Password</label>
                <input name="password" type="password" class="my-3 form-control" placeholder="Password" required />
                <div class="text-center d-flex justify-content-around align-items-center">
                    <button class="btn btn-lg btn-primary" type="submit">
                        Sign Up
                    </button>
                </div>
            </form>
        <?php } ?>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>


        <script src="./js/main.js"></script>
</body>

</html>