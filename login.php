<?php
include "includes/header.php";
if (isset($_SESSION["username"])) {
	header("Location: index.php");
}

?>
<html>

<head>
	<title>Login</title>
</head>

<body>
	<?php
	require('config.php');
	if (isset($_POST['username'])) {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		$stmt = $pdo->prepare("SELECT * FROM `users` WHERE username=? and password=?");
		$stmt->execute([$username, md5($password)]);
		$user = $stmt->fetch();
		if ($user) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $username;
			header("Location: index.php");
		} else {
			echo "<div class='text-center mt-5'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
		}
	} else {
	?>
		<div>
			<div class="container d-flex justify-content-center ">
				<form class="w-75 mt-5" method="post" name="login">
					<h1 class="text-center">Sign in</h1>
					<label>Username</label>
					<input name="username" type="text" class="my-3 form-control" placeholder="Username" required autofocus />
					<label>Password</label>
					<input name="password" type="password" class="my-3 form-control" placeholder="Password" required />
					<div class="text-center d-flex justify-content-around align-items-center">
						<button class="btn btn-lg btn-primary" type="submit">
							Sign in
						</button>
						<a href="signup.php">Create account</a>
					</div>
				</form>
			</div>
		<?php } ?>

		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
		<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>


		<script src="./js/main.js"></script>
</body>

</html>