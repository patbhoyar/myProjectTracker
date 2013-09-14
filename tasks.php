<?php
	$title = 'Tasks - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, tasks.css";
	$js = 'script.js, tasks.js';
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br>
	<div id="heading">Tasks</div>
	<br>
	<a href="addTask.php"><div id="addTask" class="button">Add Task</div></a> 
	
	<br><br><br>
	
	<div id='taskList'></div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
