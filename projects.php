<?php
	$title = 'Projects - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, projects.css";
	$js = 'script.js, projects.js, util.js';
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br>
	<div id="heading">Projects</div>
	<br>
	<a href="addProject.php"><div id="addProject">Add Project</div></a> 

	<br><br><br>

	<div id="projectList"></div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
