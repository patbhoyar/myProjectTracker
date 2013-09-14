<?php  

class Tasks
{ 
    /**
	 * Get Tasks Status Options
	 *
	 * @return json object of Tasks Status Options
	 */ 
    public static function getTaskStatusOptions(){

		$database = DB::getInstance();

		if ($statusOptions = $database->getStatusOptions("tasks")) {
			return $statusOptions;
		}else{
			return "721";
		}
    }

    /**
	 * Validate Input Task
	 *
	 * @return json object of Validated Task
	 */ 
    public static function validateTask($taskData){

		$taskData['taskCompletionDate'] = date("Y-m-d", strtotime(trim($taskData['taskCompletionDate'])));
		$taskData['taskDeadline'] = date("Y-m-d", strtotime(trim($taskData['taskDeadline'])));

		$taskName 			= trim($taskData['taskName']);
		$projName 			= trim($taskData['projectName']);
		$taskType 			= trim($taskData['taskType']);
		$taskAssignee 		= trim($taskData['taskAssignee']);
		$taskCompletionDate = $taskData['taskCompletionDate'];
		$taskDeadline 		= $taskData['taskDeadline'];
		$taskEstHrs 		= trim($taskData['taskEstHrs']);
		$taskHrsToComp 		= trim($taskData['taskHrsToCompletion']);
		$taskPriority 		= trim($taskData['taskPriority']);
		$taskStatus 		= trim($taskData['taskStatus']);
		$taskApproval 		= trim($taskData['taskApproval']);
		$taskNotes 			= trim($taskData['taskNotes']);


		if (($taskName == "") || ($taskDeadline == "") || ($taskEstHrs == ""))
			return "725";
		if ($projName == 0) 
			return "726";
		if ($taskType == 0)
			return "727";
		if ($taskAssignee == 0)
			return "729";
		if ($taskPriority == 0)
			return "730";

		if ($taskApproval == 1) {
			if ($taskCompletionDate == "1970-01-01")
				return "733";
			if ($taskHrsToComp == "")
				return "734";
			if (!is_numeric($taskHrsToComp))
			return "736";
		}
		if (!is_numeric($taskEstHrs))
			return "735";

		return $taskData;
    }

    /**
	 * Insert Task
	 *
	 * @return json object of Tasks 
	 */ 
    public static function addTask($taskData){


		$taskData['taskCompletionDate'] = "";
		$taskData['taskHrsToCompletion'] = "";

    	$tData = self::validateTask($taskData);
			
		if (is_numeric($tData))
			return $tData;

		$database = DB::getInstance();

		if ($database->addTask($tData)) {
			return "100";
		}else{
			return "728";
		}
    }

    /**
	 * Edit Task
	 *
	 * @return json object of Tasks 
	 */ 
    public static function saveEditedTask($taskData){

    	$tData = self::validateTask($taskData);
			
		if (is_numeric($tData))
			return $tData;

		$database = DB::getInstance();

		if ($database->saveEditedTask($tData)) {
			return "100";
		}else{
			return "723";
		}
    }

    /**
	 * Get Task Types
	 *
	 * @return json object of Task Types
	 */ 
    public static function getTaskTypes($projectType){

		$database = DB::getInstance();

		if ($taskTypes = $database->getTaskTypes($projectType)) {
			return $taskTypes;
		}else{
			return "722";
		}
    }

    /**
	 * Get Task Priorities
	 *
	 * @return json object of Tasks 
	 */ 
    public static function getTaskPriorities(){

		$database = DB::getInstance();

		if ($taskPriorities = $database->getTaskPriorities()) {
			return $taskPriorities;
		}else{
			return "724";
		}
    }

    /**
	 * Get Task By Id
	 *
	 * @return json object of Task
	 */ 
    public static function getTaskById($tid){

		$database = DB::getInstance();

		if ($task = $database->getTaskById($tid)) {
			return $task;
		}else{
			return "737";
		}
    }

    /**
	 * Get all Tasks
	 *
	 * @return json object of Tasks
	 */ 
    public static function getAllTasks(){

		$database = DB::getInstance();

		if ($tasks = $database->getAllTasks()) {
			return $tasks;
		}else{
			return "738";
		}
    }

    /**
	 * Get all Tasks
	 *
	 * @return json object of Tasks
	 */ 
    public static function getTaskTypesForProjectWithId($pid){

		$database = DB::getInstance();

		if ($taskTypes = $database->getTaskTypesForProjectWithId($pid)) {
			return $taskTypes;
		}else{
			return "739";
		}
    }

    /**
	 * Get all Tasks for current User
	 *
	 * @return json object of Tasks
	 */ 
    public static function getTasksForCurrentUser(){

		$database = DB::getInstance();

		if ($tasks = $database->getTasksForCurrentUser()) {
			return $tasks;
		}else{
			return "731";
		}
    }

    /**
	 * Get Tasks for given Project
	 *
	 * @return json object of Tasks
	 */ 
    public static function getTasksForProjectWithId($pid){

		$database = DB::getInstance();

		if ($tasks = $database->getTasksForProjectWithId($pid)) {
			return $tasks;
		}else{
			return "732";
		}
    }

}


?>