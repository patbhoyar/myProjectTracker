<?php  
	$title = 'SignUp - KKMedia Project Tracker';
	$loginRequired = 0;
	$title = ' ';
	$js = "newUser.js";
	require_once "includes/header.php";
?>

<div class="newUserContainer">
	<div class="text">Name</div>				<div class="newUserInput"> <input type="text" id="name"> </div>
	<div class="text">Email</div>				<div class="newUserInput"> <input type="text" id="email"> </div>
	<div class="text">Password</div>			<div class="newUserInput"> <input type="password" id="password"> </div>
	<div class="text">Confirm Password</div>	<div class="newUserInput"> <input type="password" id="confirmPassword"> </div>
	<input type="submit" value="Create Account" id="submit">
</div>

<?php require_once "includes/footer.php"; ?>