<?php
	$title = 'Tasks - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css";
	$js = 'script.js, common.js, addTask.js, util.js';
	$others = "jqueryui";
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br>
	<div id="heading">Tasks</div>
	<br>
	<div id="addTasksContainer">
		<div id="addTasksContainerTitle" class="subHeading">Add a Task</div>
		<br>
		<div id="taskNameContainer" class="itemRow"> 
			<div class="itemText"> Task Name: </div>	
			<div class="itemData"> <input type="text" id="taskName"> </div> 
		</div>
		<div id="projectNameContainer" class="itemRow"> 
			<div class="itemText"> Project Name: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="taskTypeContainer" class="itemRow">
			<div class="itemText"> Task Type: </div>	
			<div class="itemData"> Please Select a Project </div> 
		</div>
		<div id="taskAssigneeContainer" class="itemRow">
			<div class="itemText"> Task Assignee: </div>	
			<div class="itemData"> </div> 
		</div>
		<!-- <div id="taskCompletionDateContainer" class="itemRow">
			<div class="itemText"> Actual Completion Date: </div>	
			<div class="itemData"> <input type="text" id="taskCompletionDatePicker"/> </div> 
		</div> -->
		<div id="taskDeadlineContainer" class="itemRow">
			<div class="itemText"> Task Deadline Date: </div>	
			<div class="itemData"> <input type="text" id="taskDeadlineDatePicker"/> </div> 
		</div>
		<div id="taskEstimatedHoursContainer" class="itemRow">
			<div class="itemText"> Task Estimated Hours: </div>	
			<div class="itemData"> <input type="text" id="taskEstimatedHours"> </div> 
		</div>
		<!-- <div id="taskHoursToCompletionContainer" class="itemRow">
			<div class="itemText"> Task Hours to Completion: </div>	
			<div class="itemData"> <input type="text" id="taskHoursToCompletion"> </div> 
		</div> -->
		<div id="taskPriorityContainer" class="itemRow">
			<div class="itemText"> Task Priority: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="taskStatusContainer" class="itemRow">
			<div class="itemText"> Task Status: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="taskApprovalContainer" class="itemRow">
			<div class="itemText"> Task Approval: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="taskNotesContainer" class="itemRow">
			<div class="itemText"> Task Notes: </div>	
			<div class="itemData"> <textarea name="taskNotes" id="taskNotes" cols="30" rows="10"></textarea> </div> 
		</div>
		<div id="addTaskContainer" class="itemRow">
			<div class="itemText"></div>	
			<div class="itemData"> <div id="addTask" class="itemRow button"> Add Task </div> </div> 
		</div>
	</div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
