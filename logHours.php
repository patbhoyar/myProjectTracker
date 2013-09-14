<?php
	$title = 'Log Hours - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, logHours.css";
	$js = 'script.js, common.js, logHours.js, util.js';
	$others = "jqueryui";
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br>
	<div id="heading">Log Hours</div>

	<br><br>

	<div id="dateContainer">
		<div id="prevDate" class="dateOption">Yesterday</div>
		<div id="currentDate" class="dateOption"> <div id="dateIcon"> <input type="text" id="datepicker" /> </div> <div id="today"></div> </div>
		<div id="nextDate" class="dateOption">Tomorrow</div>
	</div>

	<br><br>
	
	<div id="newTaskContainer">
		<div id="taskHeading" class="taskRow">
			<div class="taskStatus taskItem">Status</div>
			<div class="taskPriority taskItem">Priority</div>
			<div class="taskName taskItem">Task Name</div>
			<div class="taskHours taskItem">Hours</div>
			<div class="taskNotes taskItem">Notes</div>
		</div>
	</div>

	<br><br>

	<div id="saveLog" class="button">Save Changes</div>
	<div id="addLog" class="button">Add Task</div>

	<br><br>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
