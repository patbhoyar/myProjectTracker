<?php  
/**
 * This class is the responsible for all the database interactions 
 *
 * @copyright  2012  
 * @license    http://www. .com
 * @version    Release: @package_version@
 * @link       http://www. .com
 * @since      Class available since Release 1.0
 */ 
class DB
{ 
    private static $instance; 
    private static $db;

    private static $config = array(
		'host'   	=>	'kkmediadb.cmnj6dg74wwe.us-west-1.rds.amazonaws.com',
		'username' 	=>	'kkmediadb',
		'password' 	=>	'kkpsddb*804',
		'dbname' 	=>	'projectTracker'
	);

    /**
	 * Creates a Connection to the database using PDO
	 *
	 */ 
    private function __construct() { 
    	try {
			self::$db = new PDO("mysql:host=".self::$config['host'].";dbname=".self::$config['dbname'],self::$config['username'],self::$config['password']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }	
    } 

    /**
	 * Creates a Singleton Object of the obeyDB Class
	 *
	 * @return Singleton Object of the obeyDB Class
	 */ 
    public static function getInstance() 
    { 
        if (!self::$instance) 
        { 
            self::$instance = new DB(); 
        } 
        return self::$instance; 
    } 

    public function getAllUsers(){

        $query = self::$db->prepare("CALL getAllUsers()");
        if ($query->execute()) {
            if($query->rowCount() != 0){
                $userList = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $userInfo = array();
                    $userInfo["id"] = $row['id'];
                    $userInfo["name"] = $row['name'];
                    $userList[] = $userInfo;
                }
                return json_encode($userList);
            }else
                return 0;
        }else{
            return 0;
        }
    }

    public function createNewUser($userData){

    	$userType = 2;

		$query = self::$db->prepare("CALL insertNewUser(?,?,?,?)");
		$query->bindParam(1, $userData["name"], PDO::PARAM_STR); 
		$query->bindParam(2, $userData["email"], PDO::PARAM_STR); 
		$query->bindParam(3, sha1($userData["password"]), PDO::PARAM_STR); 
		$query->bindParam(4, $userType, PDO::PARAM_INT); 
		return $query->execute();
	
	}

	public function loginUser($userData){

		$query = self::$db->prepare("CALL checkUserCredentials(?,?)");
		$query->bindParam(1, $userData["email"], PDO::PARAM_STR); 
		$query->bindParam(2, sha1($userData["password"]), PDO::PARAM_STR); 
		$query->execute();
		if($query->rowCount() == 1){
			return 1;
		}else{
			return 0;
		}

	}

	public function getUserInfo($email){

        $query = self::$db->prepare("CALL getUserByEmail(?)");
        $query->bindParam(1, $email, PDO::PARAM_STR); 
        $query->execute();
        if($query->rowCount() == 1){
            $userInfo = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $userInfo["userId"] = $row['id'];
                $userInfo["userEmail"] = $row['email'];
                $userInfo["userName"] = $row['name'];
                $userInfo["userType"] = $row['userType'];
            }
            return json_encode($userInfo);
        }else{
            return 0;
        }
    }

    public function getStatusOptions($optionsFor){

        switch ($optionsFor) {
            case 'clients':
                $sp = "getClientStatusOptions()";
                break;
            case 'projects':
                $sp = "getProjectStatusOptions()";
                break;
            case 'tasks':
                $sp = "getTaskStatusOptions()";
                break;
        }

        $query = self::$db->prepare("CALL $sp");
        $query->execute();
        if($query->rowCount() > 0){
            $statusOptions = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $theOption = array();
                $theOption["id"] = $row['id'];
                $theOption["status"] = $row['statusType'];
                $statusOptions[] = $theOption;
            }

            return json_encode($statusOptions);
        }else{
            return 0;
        }

    }



    /*
        Clients
    */

    public function addClient($clientData){

        $query = self::$db->prepare("CALL insertNewClient(?,?)");
        $query->bindParam(1, $clientData["name"], PDO::PARAM_STR); 
        $query->bindParam(2, $clientData["status"], PDO::PARAM_STR); 
        $query->execute();

        return self::getAllClients();
    }

    public function getAllClients(){

        $query = self::$db->prepare("CALL getAllClients()");
        $query->execute();
        if($query->rowCount() > 0){
            $clients = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $theClient = array();
                $theClient["id"] = $row['id'];
                $theClient["name"] = strtoupper($row['clientName']);
                $theClient["status"] = $row['clientStatus'];
                $clients[] = $theClient;
            }

            return json_encode($clients);
        }else{
            return 0;
        }
    }

    public function getProjectsForClientWithId($id){

        $query = self::$db->prepare("CALL getProjectsForClientWithId(?)");
        $query->bindParam(1, $id, PDO::PARAM_INT); 
        
        if ($query->execute()) {
            
            if($query->rowCount() > 0){
                $projects = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $projectInfo = array();
                    $projectInfo["id"] = $row['id'];
                    $projectInfo["projectName"] = $row['projectName'];
                    $projects[] = $projectInfo;
                }

                return json_encode($projects);
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function saveEditedClients($clientNewData){

        $query = self::$db->prepare("CALL saveEditedClient(?,?,?)");
        $query->bindParam(1, $clientNewData["id"], PDO::PARAM_INT); 
        $query->bindParam(2, $clientNewData["name"], PDO::PARAM_STR); 
        $query->bindParam(3, $clientNewData["status"], PDO::PARAM_INT); 
        if ($query->execute()) {
            return 1;
        }else{
            return 0;
        }

    }


    /*
        Projects
    */

    public function getAllProjects(){

        require_once($_SERVER['DOCUMENT_ROOT'].'/config/en.php');

        $query = self::$db->prepare("CALL getAllProjects()");
        $query->execute();
        if($query->rowCount() > 0){
            $projects = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $theProject = array();
                $theProject["id"] = $row['pcid'];
                $theProject["shortProjectName"] = Util::reduceStringSizeTo($row['projectName'], $sizes['MAX_PROJECT_NAME_SIZE']);
                $theProject["fullProjectName"] = $row['projectName'];
                $theProject["shortProjectType"] = Util::reduceStringSizeTo($row['type'], $sizes['MAX_PROJECT_TYPE_SIZE']);
                $theProject["fullProjectType"] = $row['type'];
                $theProject["shortClientName"] = Util::reduceStringSizeTo($row['clientName'], $sizes['MAX_CLIENT_NAME_SIZE']);
                $theProject["fullClientName"] = $row['clientName'];
                $theProject["projectStartDate"] = $row['projectStartDate'];
                $theProject["projectEndDate"] = $row['projectEndDate'];
                $theProject["projectEstimatedHours"] = $row['projectEstimatedHours'];
                $theProject["shortProjectStatus"] = Util::reduceStringSizeTo($row['status'], $sizes['MAX_PROJECT_STATUS_SIZE']);;
                $theProject["fullProjectStatus"] = $row['status'];
                $theProject["projectBudget"] = $row['projectBudget'];
                $theProject["shortProjectNotes"] = Util::reduceStringSizeTo($row['projectNotes'], $sizes['MAX_NOTES_SIZE']);
                $theProject["fullProjectNotes"] = $row['projectNotes'];
                $projects[] = $theProject;
            }

            return json_encode($projects);
        }else{
            return 0;
        }
    }

    public function getProjectTypeOptions(){

        $query = self::$db->prepare("CALL getProjectTypeOptions");
        $query->execute();
        if($query->rowCount() > 0){
            $projectTypeOptions = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $theOption = array();
                $theOption["id"] = $row['id'];
                $theOption["projectType"] = $row['projectType'];
                $projectTypeOptions[] = $theOption;
            }

            return json_encode($projectTypeOptions);
        }else{
            return 0;
        }
    }

    public function addProject($projectData){

        $query = self::$db->prepare("CALL insertNewProject(?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $projectData["projName"], PDO::PARAM_STR); 
        $query->bindParam(2, $projectData["projType"], PDO::PARAM_INT); 
        $query->bindParam(3, $projectData["projClient"], PDO::PARAM_INT); 
        $query->bindParam(4, $projectData["projStartDate"], PDO::PARAM_STR); 
        $query->bindParam(5, $projectData["projEndDate"], PDO::PARAM_STR); 
        $query->bindParam(6, $projectData["projEstHours"], PDO::PARAM_INT); 
        $query->bindParam(7, $projectData["projStatus"], PDO::PARAM_INT); 
        $query->bindParam(8, $projectData["projBudget"], PDO::PARAM_INT); 
        $query->bindParam(9, $projectData["projNotes"], PDO::PARAM_STR); 

        return $query->execute();
    }

    public function saveEditedProject($projectData){

        $query = self::$db->prepare("CALL saveEditedProject(?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $projectData["projId"], PDO::PARAM_INT); 
        $query->bindParam(2, $projectData["projName"], PDO::PARAM_STR); 
        $query->bindParam(3, $projectData["projClient"], PDO::PARAM_INT); 
        $query->bindParam(4, $projectData["projType"], PDO::PARAM_INT); 
        $query->bindParam(5, $projectData["projStartDate"], PDO::PARAM_STR); 
        $query->bindParam(6, $projectData["projEndDate"], PDO::PARAM_STR); 
        $query->bindParam(7, $projectData["projEstHours"], PDO::PARAM_INT); 
        $query->bindParam(8, $projectData["projStatus"], PDO::PARAM_INT); 
        $query->bindParam(9, $projectData["projBudget"], PDO::PARAM_INT); 
        $query->bindParam(10, $projectData["projNotes"], PDO::PARAM_STR); 

        return $query->execute();
    }

    public function getProjectById($pid){

        $query = self::$db->prepare("CALL getProjectById(?)");
        $query->bindParam(1, $pid, PDO::PARAM_INT); 
        $query->execute();
        if($query->rowCount() > 0){
            $project = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $project["id"] = $row['pcid'];
                $project["projectName"] = $row['projectName'];
                $project["projectType"] = $row['type'];
                $project["clientName"] = $row['clientName'];
                $project["projectStartDate"] = $row['projectStartDate'];
                $project["projectEndDate"] = $row['projectEndDate'];
                $project["projectEstimatedHours"] = $row['projectEstimatedHours'];
                $project["projectStatus"] = $row['status'];
                $project["projectBudget"] = $row['projectBudget'];
                $project["projectNotes"] = $row['projectNotes'];
            }

            return json_encode($project);
        }else{
            return 0;
        }
    }

    public function getProjectsForClient($cid){

        $query = self::$db->prepare("CALL getProjectsForClient(?)");
        $query->bindParam(1, $cid, PDO::PARAM_INT); 
        $query->execute();
        if($query->rowCount() > 0){
            $projectList = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $project = array();
                $project["id"] = $row['id'];
                $project["projectName"] = $row['projectName'];
                $projectList[] = $project;
            }

            return json_encode($projectList);
        }else{
            return 0;
        }
    }


    /*
        Tasks
    */

    public function getTaskTypes($projectType){
        $query = self::$db->prepare("CALL getTaskTypeOptions(?)");
        $query->bindParam(1, $projectType, PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                $taskTypes = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskType = array();
                    $taskType["id"] = $row['id'];
                    $taskType["taskType"] = $row['taskType'];
                    $taskTypes[] = $taskType;
                }
                return json_encode($taskTypes);
            }
        }else{
            return 0;
        }
    }

    public function getTaskPriorities(){
        $query = self::$db->prepare("CALL getTaskPriorities()");
        if ($query->execute()) {
            if($query->rowCount() > 0){
                $taskPriorities = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskPriority = array();
                    $taskPriority["id"] = $row['id'];
                    $taskPriority["priorityName"] = $row['priorityName'];
                    $taskPriorities[] = $taskPriority;
                }
                return json_encode($taskPriorities);
            }
        }else{
            return 0;
        }
    }

    public function addTask($taskData){
        $query = self::$db->prepare("CALL addTask(?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $taskData["projectName"], PDO::PARAM_INT); 
        $query->bindParam(2, $taskData["taskName"], PDO::PARAM_STR); 
        $query->bindParam(3, $taskData["taskType"], PDO::PARAM_INT); 
        $query->bindParam(4, $taskData["taskAssignee"], PDO::PARAM_INT); 
        $query->bindParam(5, $taskData["taskCompletionDate"], PDO::PARAM_STR); 
        $query->bindParam(6, $taskData["taskDeadline"], PDO::PARAM_STR); 
        $query->bindParam(7, $taskData["taskEstHrs"], PDO::PARAM_INT); 
        $query->bindParam(8, $taskData["taskHrsToCompletion"], PDO::PARAM_INT); 
        $query->bindParam(9, $taskData["taskPriority"], PDO::PARAM_INT); 
        $query->bindParam(10, $taskData["taskStatus"], PDO::PARAM_INT); 
        $query->bindParam(11, $taskData["taskApproval"], PDO::PARAM_INT); 
        $query->bindParam(12, $taskData["taskNotes"], PDO::PARAM_STR); 

        return $query->execute();
    }

    public function saveEditedTask($taskData){
        $query = self::$db->prepare("CALL saveEditedTask(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $taskData["tid"], PDO::PARAM_INT); 
        $query->bindParam(2, $taskData["taskName"], PDO::PARAM_STR); 
        $query->bindParam(3, $taskData["projectName"], PDO::PARAM_INT); 
        $query->bindParam(4, $taskData["taskType"], PDO::PARAM_INT); 
        $query->bindParam(5, $taskData["taskAssignee"], PDO::PARAM_INT); 
        $query->bindParam(6, $taskData["taskCompletionDate"], PDO::PARAM_STR); 
        $query->bindParam(7, $taskData["taskDeadline"], PDO::PARAM_STR); 
        $query->bindParam(8, $taskData["taskEstHrs"], PDO::PARAM_INT); 
        $query->bindParam(9, $taskData["taskHrsToCompletion"], PDO::PARAM_INT); 
        $query->bindParam(10, $taskData["taskPriority"], PDO::PARAM_INT); 
        $query->bindParam(11, $taskData["taskStatus"], PDO::PARAM_INT); 
        $query->bindParam(12, $taskData["taskApproval"], PDO::PARAM_INT); 
        $query->bindParam(13, $taskData["taskNotes"], PDO::PARAM_STR); 

        return $query->execute();
    }

    public function getTaskById($tid){
        $query = self::$db->prepare("CALL getTaskById(?)");
        $query->bindParam(1, $tid, PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                $taskInfo = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskInfo["id"] = $row['id'];
                    $taskInfo["projectName"] = $row['projectName'];
                    $taskInfo["taskType"] = $row['taskType'];
                    $taskInfo["taskName"] = $row['taskName'];
                    $taskInfo["taskAssignee"] = $row['taskAssignee'];
                    $taskInfo["taskCompletionDate"] = $row['taskCompletionDate'];
                    $taskInfo["taskDeadline"] = $row['taskDeadline'];
                    $taskInfo["taskEstHrs"] = $row['taskEstimatedHours'];
                    $taskInfo["taskHrsToCompletion"] = $row['taskHoursToCompletion'];
                    $taskInfo["taskPriority"] = $row['taskPriority'];
                    $taskInfo["taskStatus"] = $row['taskStatus'];
                    $taskInfo["taskApproval"] = $row['taskApproval'];
                    $taskInfo["taskNotes"] = $row['taskNotes'];
                }
                return json_encode($taskInfo);
            }
        }else{
            return 0;
        }
    }

    public function getAllTasks(){

        require_once($_SERVER['DOCUMENT_ROOT'].'/config/en.php');

        $query = self::$db->prepare("CALL getAllTasks()");
        if ($query->execute()) {
            if($query->rowCount() > 0){
                $tasks = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskInfo = array();
                    $taskInfo["id"] = $row['id'];
                    $taskInfo["taskStatus"] = $row['taskStatus'];
                    $taskInfo["taskPriority"] = $row['taskPriority'];
                    $taskInfo["taskDeadline"] = $row['taskDeadline'];
                    $taskInfo["taskName"] = $row['taskName'];
                    $taskInfo["fullTaskNotes"] = $row['taskNotes'];
                    $taskInfo["shortTaskNotes"] = Util::reduceStringSizeTo($row['taskNotes'], $sizes['MAX_TASK_NOTES_SIZE']);
                    $tasks[] = $taskInfo;
                }
                return json_encode($tasks);
            }
        }else{
            return 0;
        }
    }

    public function getTaskTypesForProjectWithId($pid){

        $query = self::$db->prepare("CALL getTaskTypesForProjectWithId(?)");
        $query->bindParam(1, $pid, PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                $taskTypes = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskType = array();
                    $taskType["id"] = $row['id'];
                    $taskType["taskType"] = $row['taskType'];
                    $taskTypes[] = $taskType;
                }
                return json_encode($taskTypes);
            }
        }else{
            return 0;
        }
    }

    public function getTasksForCurrentUser(){
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/config/en.php');

        $data = self::getUserInfo(Session::get("LoggedIn"));
        $user = json_decode($data, 1);

        $query = self::$db->prepare("CALL getTasksForCurrentUser(?)");
        $query->bindParam(1, $user["userId"], PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                 $tasks = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskInfo = array();
                    $taskInfo["id"] = $row['id'];
                    $taskInfo["taskStatus"] = $row['taskStatus'];
                    $taskInfo["taskPriority"] = $row['taskPriority'];
                    $taskInfo["taskName"] = $row['taskName'];
                    $taskInfo["fullTaskNotes"] = $row['taskNotes'];
                    $taskInfo["shortTaskNotes"] = Util::reduceStringSizeTo($row['taskNotes'], $sizes['MAX_TASK_NOTES_SIZE']);
                    $tasks[] = $taskInfo;
                }
                return json_encode($tasks);
            }
        }else{
            return 0;
        }
    }

    public function getTasksForProjectWithId($pid){
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/config/en.php');

        $query = self::$db->prepare("CALL getTasksForProjectWithId(?)");
        $query->bindParam(1, $pid, PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                 $tasks = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskInfo = array();
                    $taskInfo["id"] = $row['id'];
                    $taskInfo["taskStatus"] = $row['taskStatus'];
                    $taskInfo["taskPriority"] = $row['taskPriority'];
                    $taskInfo["taskDeadline"] = $row['taskDeadline'];
                    $taskInfo["taskName"] = $row['taskName'];
                    $taskInfo["fullTaskNotes"] = $row['taskNotes'];
                    $taskInfo["shortTaskNotes"] = Util::reduceStringSizeTo($row['taskNotes'], $sizes['MAX_TASK_NOTES_SIZE']);
                    $tasks[] = $taskInfo;
                }
                return json_encode($tasks);
            }
        }else{
            return 0;
        }
    }


    /*
        Log Hours
    */

    public function getTasksForDate($date){
        $query = self::$db->prepare("CALL getTasksForProjectWithId(?)");
        $query->bindParam(1, $pid, PDO::PARAM_INT); 
        if ($query->execute()) {
            if($query->rowCount() > 0){
                 $tasks = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $taskInfo = array();
                    $taskInfo["id"] = $row['id'];
                    $taskInfo["taskStatus"] = $row['taskStatus'];
                    $taskInfo["taskPriority"] = $row['taskPriority'];
                    $taskInfo["taskDeadline"] = $row['taskDeadline'];
                    $taskInfo["taskName"] = $row['taskName'];
                    $taskInfo["fullTaskNotes"] = $row['taskNotes'];
                    $taskInfo["shortTaskNotes"] = Util::reduceStringSizeTo($row['taskNotes'], $sizes['MAX_TASK_NOTES_SIZE']);
                    $tasks[] = $taskInfo;
                }
                return json_encode($tasks);
            }
        }else{
            return 0;
        }
    }

    public function enterHours($data){

        $querySuccess = 1;
        $js = json_decode($data, 1);
        $arr = $js["data"];

        $userdata = self::getUserInfo(Session::get("LoggedIn"));
        $user = json_decode($userdata, 1);

        for ($i=0; $i < sizeof($arr); $i++) { 
            $theDate = date("Y-m-d", strtotime(trim($arr[$i]["date"])));
            $query = self::$db->prepare("CALL saveLoggedHours(?,?,?,?,?)");
            $query->bindParam(1, $arr[$i]["id"], PDO::PARAM_INT); 
            $query->bindParam(2, $user["userId"], PDO::PARAM_INT); 
            $query->bindParam(3, $arr[$i]["hours"], PDO::PARAM_INT); 
            $query->bindParam(4, $theDate, PDO::PARAM_STR); 
            $query->bindParam(5, $arr[$i]["notes"], PDO::PARAM_STR);

            //mark task completed if status == 1
            if ($arr[$i]["status"]) {
                $taskquery = self::$db->prepare("CALL saveCompletedTask(?)");
                $taskquery->bindParam(1, $arr[$i]["id"], PDO::PARAM_INT); 
                if ($taskquery->execute()) {
                     $querySuccess = 1;
                }else{
                    $querySuccess = 0;
                    break;
                } 
            }

            if ($query->execute()) {
                 $querySuccess = 1;
            }else{
                $querySuccess = 0;
                break;
            } 
        }

        if ($querySuccess == 1) {
            return "success";
        }else{
            return "unsuccessfull";
        }
    }

}  


















































 ?>