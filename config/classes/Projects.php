<?php  

class Projects
{ 
    /**
	 * Get Projects Status Options
	 *
	 * @return json object of Projects Status Options
	 */ 
    public static function getProjectStatusOptions(){

		$database = DB::getInstance();

		if ($statusOptions = $database->getStatusOptions("projects")) {
			return $statusOptions;
		}else{
			return "621";
		}
    }

    /**
	 * Insert Project
	 *
	 * @return json object of Projects 
	 */ 
    public static function addProject($projectData){

		$database = DB::getInstance();

		if ($database->addProject($projectData)) {
			return "100";
		}else{
			return "628";
		}
    }

    /**
	 * Save Edited Project
	 *
	 * @return json object of Projects 
	 */ 
    public static function saveEditedProject($projectData){

		$database = DB::getInstance();

		if ($database->saveEditedProject($projectData)) {
			return "100";
		}else{
			return "630";
		}
    }

    /**
	 * Get All Projects
	 *
	 * @return json object of Projects 
	 */ 
    public static function getAllProjects(){

		$database = DB::getInstance();

		if ($projectList = $database->getAllProjects()) {
			return $projectList;
		}else{
			return "622";
		}
    }

    /**
	 * Get Project Types
	 *
	 * @return json object of Project Types
	 */ 
    public static function getProjectTypeOptions(){

		$database = DB::getInstance();

		if ($projectTypeOptions = $database->getProjectTypeOptions()) {
			return $projectTypeOptions;
		}else{
			return "625";
		}
    }

    /**
	 * Get Project By ID
	 *
	 * @return json object of Project 
	 */ 
    public static function getProjectById($pid){

		$database = DB::getInstance();

		if ($project = $database->getProjectById($pid)) {
			return $project;
		}else{
			return "629";
		}
    }

    /**
	 * Get Projects for client
	 *
	 * @return json object of Project 
	 */ 
    public static function getProjectsForClient($cid){

		$database = DB::getInstance();

		if ($project = $database->getProjectsForClient($cid)) {
			return $project;
		}else{
			return "631";
		}
    }

   

}


?>