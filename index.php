<?php
	$title = 'KKMedia Project Tracker';
	$loginRequired = 1;
	//$css = " .css";
	$js = 'script.js';
	include(dirname(__FILE__) . '/includes/header.php');
?>
	Hello 
	<?php 
		echo Session::get("userName"); 

		if (Session::get("userType") == 1) {
			echo "  (Admin)";
		}
	?>
	<br>
	<a href="#" id="logout">Logout</a>
<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>