<?php
	$title = 'Tasks - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, viewTask.css";
	$js = 'script.js, common.js, viewTask.js, util.js';
	$others = "jqueryui";
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br><br>
	<div id="heading"></div>
	<br>
	
	<div id="addTasksContainer">
		<div id="projectNameContainer" class="itemRow"> 
			<div class="itemText"> Project Name: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="taskTypeContainer" class="itemRow">
			<div class="itemText"> Task Type: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="taskAssigneeContainer" class="itemRow">
			<div class="itemText"> Task Assignee: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="taskCompletionDateContainer" class="itemRow">
			<div class="itemText"> Actual Completion Date: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="taskDeadlineContainer" class="itemRow">
			<div class="itemText"> Task Deadline Date: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="taskEstimatedHoursContainer" class="itemRow">
			<div class="itemText"> Task Estimated Hours: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="taskHoursToCompletionContainer" class="itemRow">
			<div class="itemText"> Hours spent on Task: </div>	
			<div class="itemData">  </div> 
		</div>
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
			<div class="itemData">  </div> 
		</div>
		<div id="editTaskContainer" class="itemRow">
			<div class="itemText"> <div id="editTask" class="button"> Edit Task </div> </div>	
			<div class="itemData">   </div> 
		</div>
	</div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
