<?php 
	$title = 'Login - KKMedia Project Tracker';
	$loginRequired = 0;
	$css = "style.css";
	$js = "login.js";
	require_once "includes/header.php";
?>

<div class="loginContainer">
	<div class="text">Email</div><div class="loginInput"> <input type="text" id="email"> </div>
	<div class="text">Password</div><div class="loginInput"> <input type="password" id="password"> </div>
	<input type="submit" value="Login" id="submit">
</div>

<div>
	If you dont have an account <a href="newUser.php">Click Here</a>
</div>

<?php require_once "includes/footer.php"; ?>