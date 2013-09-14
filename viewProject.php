<?php
	$title = 'Projects - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, addProject.css, tasks.css";
	$js = 'script.js, common.js, viewProject.js, util.js';
	$others = "jqueryui";
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br><br>
	<div id="preHeading">Project Details for&nbsp;</div><div id="heading"></div>
	<br>
	
	<div id="addProjectsContainer">
		<div id="projectClientContainer" class="itemRow">
			<div class="itemText"> Project Client: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="projectTypeContainer" class="itemRow">
			<div class="itemText"> Project Type: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="projectStartDateContainer" class="itemRow">
			<div class="itemText"> Project Start Date: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="projectEndDateContainer" class="itemRow">
			<div class="itemText"> Project End Date: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="projectEstimatedHoursContainer" class="itemRow">
			<div class="itemText"> Project Estimated Hours: </div>	
			<div class="itemData">  </div> 
		</div>
		<div id="projectStatusContainer" class="itemRow">
			<div class="itemText"> Project Status: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="projectBudgetContainer" class="itemRow">
			<div class="itemText"> Project Budget: </div>	
			<div class="itemData">   </div> 
		</div>
		<div id="projectNotesContainer" class="itemRow">
			<div class="itemText"> Project Notes: </div>	
			<div class="itemData">   </div> 
		</div>
		<div id="editProjectContainer" class="itemRow">
			<div class="itemText"> <div id="editProject" class="button"> Edit Project </div> </div>	
			<div class="itemData"> <div id="addTask" class="button"> Add Task </div> </div> 
		</div>
	</div>
	<br><br>

	<div id='taskList'></div>
	<div id='noTasks'>No Tasks created for this Project.</div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
