<?php
	$title = 'Projects - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, addProject.css";
	$js = 'script.js, addProject.js, util.js';
	$others = "jqueryui";
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<br>
	<div id="heading">Projects</div>
	<br>
	
	<div id="addProjectsContainer">
		<div id="addProjectsContainerTitle" class="subHeading">Add a Project</div>
		<br>
		<div id="projectNameContainer" class="itemRow"> 
			<div class="itemText"> Project Name: </div>	
			<div class="itemData"> <input type="text" id="projectName"> </div> 
		</div>
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
			<div class="itemData"> <input type="text" id="startDatePicker"/> </div> 
		</div>
		<div id="projectEndDateContainer" class="itemRow">
			<div class="itemText"> Project End Date: </div>	
			<div class="itemData"> <input type="text" id="endDatePicker"/> </div> 
		</div>
		<div id="projectEstimatedHoursContainer" class="itemRow">
			<div class="itemText"> Project Estimated Hours: </div>	
			<div class="itemData"> <input type="text" id="projectEstimatedHours"> </div> 
		</div>
		<div id="projectStatusContainer" class="itemRow">
			<div class="itemText"> Project Status: </div>	
			<div class="itemData"> </div> 
		</div>
		<div id="projectBudgetContainer" class="itemRow">
			<div class="itemText"> Project Budget: </div>	
			<div class="itemData"> <input type="text" id="projectBudget"> </div> 
		</div>
		<div id="projectNotesContainer" class="itemRow">
			<div class="itemText"> Project Notes: </div>	
			<div class="itemData"> <textarea name="projectNotes" id="projectNotes" cols="30" rows="10"></textarea> </div> 
		</div>
		<div id="addProjectContainer" class="itemRow">
			<div class="itemText"></div>	
			<div class="itemData"> <div id="addProject" class="itemRow button"> Add Project </div> </div> 
		</div>
		
	</div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>
