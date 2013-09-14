<?php
	$title = 'Admin - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, admin.css, tasks.css";
	$js = 'script.js, util.js, common.js, admin.js';
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>

	<div id="selectClientContainer" class="itemRow"> 
		<div class="itemText"> Select Client: </div>	
		<div class="itemData"> </div> 
	</div>
	<div id="selectProjectContainer" class="itemRow"> 
		<div class="itemText"> Select Project: </div>	
		<div class="itemData"> </div> 
	</div>

	<br>
	<div id="addProjectView"></div>
	<div id="addTaskView"></div>
	<div id="errorView"></div>
	<div id="taskView"></div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>