<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/config/init.php');

	$request = $_POST['request'];

	switch ($request) {
		case 'createUser':

			$data = array(
				"name" 				=> $_POST['name'],
				"email" 			=> $_POST['email'],
				"password" 			=> $_POST['password'],
				"confirmPassword" 	=> $_POST['confirmPassword']
			);

			$returnCode = User::createUser($data);
			echo Util::createReturnObject($returnCode);

			break;
		case 'login':

			$data = array(
				"email" 			=> $_POST['email'],
				"password" 			=> $_POST['password']
			);

			$returnCode = User::loginUser($data);
			if ($returnCode == "100") {
				Session::set("LoggedIn", $data["email"]);

				$userInfo = User::getUserInfo();
	            if ($userInfo != "505") {
	                $obj = json_decode($userInfo, 1);
	                Session::set("userName", $obj["userName"]);
	                Session::set("userType", $obj["userType"]);
	            }

			}
			echo Util::createReturnObject($returnCode);

			break;
		case 'logout':
			Session::destroy();
			break;
		case 'getUserInfo':

			$userData = User::getUserInfo();
			if ($userData != "505") {
				echo Util::createReturnObject("100", $userData);
			}else{
				header("Location: ".$domain."login.php");
			}

			break;
		case 'getClientStatusOptions':
			echo Clients::getClientStatusOptions();
			break;
		case 'getProjectStatusOptions':
			echo Projects::getProjectStatusOptions();
			break;
		case 'getTaskStatusOptions':
			echo Tasks::getTaskStatusOptions();
			break;


		/*
			Clients
		*/	
		case 'addClient':

			$name = trim($_POST['name']);
			$status = trim($_POST['status']);

			if ($name == "") {
				echo Util::createReturnObject("523");
				break;
			}

			$clientData = array(
				"name" 		=> $_POST['name'],
				"status" 	=> $_POST['status']
			);

			$clientData = Clients::addClient($clientData);
			if ($clientData != "522") {
				echo Util::createReturnObject("100", $clientData);
			}else{
				echo Util::createReturnObject($clientData);
			}

			break;
		case 'getAllClients':

			$clients = Clients::getAllClients();
			if ($clients != "522") {
				echo Util::createReturnObject("100", $clients);
			}else{
				echo Util::createReturnObject($clients);
			}

			break;
		case 'saveClients':

			$clients = Clients::saveEditedClients($_POST['data']);
			if ($clients != "525") {
				echo Util::createReturnObject("100", $clients);
			}else{
				echo Util::createReturnObject($clients);
			}

			break;
		case 'getProjectsForClientWithId':

				$clientInfo = Clients::getProjectsForClientWithId($_POST['id']);
				if ($clientInfo != "526") {
					echo Util::createReturnObject("100", $clientInfo);
				}else{
					echo Util::createReturnObject($clientInfo);
				}

			break;


		/*
			Projects
		*/
		case 'getProjectTypeOptions':
			echo Projects::getProjectTypeOptions();
			break;
		case 'addProject':

			$projectData = validateProjectInput();
			if (is_numeric($projectData)) {
				echo Util::createReturnObject($projectData);
				break;
			}

			$projectData = Projects::addProject($projectData);
			echo Util::createReturnObject($projectData);

			break;
		case 'saveEditedProject':

			$projectData = validateProjectInput();
			if (is_numeric($projectData)) {
				echo Util::createReturnObject($projectData);
				break;
			}

			$projectData = Projects::saveEditedProject($projectData);
			echo Util::createReturnObject($projectData);

			break;
		case "getAllProjects":

			$projects = Projects::getAllProjects();
			if ($projects != "622") {
				echo Util::createReturnObject("100", $projects);
			}else{
				echo Util::createReturnObject($projects);
			}
			break;
		case "getProjectById":

			$project = Projects::getProjectById($_POST["pid"]);
			if ($project != "629") {
				echo Util::createReturnObject("100", $project);
			}else{
				echo Util::createReturnObject($project);
			}
			break;
		case "getProjectsForClient":

			$projects = Projects::getProjectsForClient($_POST["cid"]);
			if ($projects != "631") {
				echo Util::createReturnObject("100", $projects);
			}else{
				echo Util::createReturnObject($projects);
			}
			break;


		/*
			Tasks
		*/
		case "getTaskTypes":

			$taskTypes = Tasks::getTaskTypes($_POST['projectType']);
			if ($taskTypes != "723") {
				echo Util::createReturnObject("100", $taskTypes);
			}else{
				echo Util::createReturnObject($taskTypes);
			}
			break;
		case "getAllUsers":

			$users = User::getAllUsers();
			if ($users != "506") {
				echo Util::createReturnObject("100", $users);
			}else{
				echo Util::createReturnObject($users);
			}
			break;
		case "getTaskPriorities":

			$taskPriorities = Tasks::getTaskPriorities();
			if ($taskPriorities != "724") {
				echo Util::createReturnObject("100", $taskPriorities);
			}else{
				echo Util::createReturnObject($taskPriorities);
			}
			break;
		case "addTask":

			$task = Tasks::addTask($_POST['data']);
			if ($task == "100") {
				echo Util::createReturnObject("100", $task);
			}else{
				echo Util::createReturnObject($task);
			}
			break;
		case 'saveEditedTask':

			$task = Tasks::saveEditedTask($_POST['task']);

			//var_dump($task);

			if ($task == "100") {
				echo Util::createReturnObject("100", $task);
			}else{
				echo Util::createReturnObject($task);
			}
			break;
		case "getTaskById":

			$task = Tasks::getTaskById($_POST['tid']);
			if ($task != "737") {
				echo Util::createReturnObject("100", $task);
			}else{
				echo Util::createReturnObject($task);
			}
			break;
		case "getAllTasks":

			$tasks = Tasks::getAllTasks();
			if ($tasks != "738") {
				echo Util::createReturnObject("100", $tasks);
			}else{
				echo Util::createReturnObject($tasks);
			}
			break;
		case "getTaskTypesForProjectWithId":

			$taskTypes = Tasks::getTaskTypesForProjectWithId($_POST['projId']);
			if ($taskTypes != "739") {
				echo Util::createReturnObject("100", $taskTypes);
			}else{
				echo Util::createReturnObject($taskTypes);
			}
			break;
		case "getTasksForCurrentUser":

			$tasks = Tasks::getTasksForCurrentUser();
			if ($tasks != "731") {
				echo Util::createReturnObject("100", $tasks);
			}else{
				echo Util::createReturnObject($tasks);
			}
			break;
		case "getTasksForProjectWithId":

			$tasks = Tasks::getTasksForProjectWithId($_POST['pid']);
			if ($tasks != "732") {
				echo Util::createReturnObject("100", $tasks);
			}else{
				echo Util::createReturnObject($tasks);
			}
			break;

		/*
			Log Hours
		*/
		case "getTasksForDate":
			$tasks = Log::getTasksForDate($_POST['date']);
			if ($tasks != "822") {
				echo Util::createReturnObject("100");
			}else{
				echo Util::createReturnObject($tasks);
			}
			break;
		case "saveLog":
			$logged = Log::enterHours($_POST['data']);
			if ($logged != "821") {
				echo Util::createReturnObject("100", $logged);
			}else{
				echo Util::createReturnObject($logged);
			}
			break;
	}

function validateProjectInput(){

	$proj = $_POST['proj'];

	$projectData = array(
		"projId" 			=> trim($proj['pid']),
		"projName" 			=> trim($proj['projName']),
		"projClient" 		=> trim($proj['projClient']),
		"projType" 			=> trim($proj['projType']),
		"projStartDate" 	=> date("Y-m-d", strtotime(trim($proj['projStartDate']))),
		"projEndDate" 		=> date("Y-m-d", strtotime(trim($proj['projEndDate']))),
		"projEstHours" 		=> trim($proj['projEstHours']),
		"projStatus" 		=> trim($proj['projStatus']),
		"projBudget" 		=> trim($proj['projBudget']),
		"projNotes" 		=> trim($proj['projNotes'])
	);

	if (($projectData['projName'] == "") || ($projectData['projClient'] == 0) || ($projectData['projType'] == 0) || ($projectData['projStartDate'] == "") || ($projectData['projEndDate'] == "") || ($projectData['projEstHours'] == "") || ($projectData['projStatus'] == 0) || ($projectData['projBudget'] == "")) {
		return "623";
	}

	if (!is_numeric($projectData['projEstHours'])) {
		return "624";
	}

	if (!is_numeric($projectData['projBudget'])) {
		return "626";
	}

	if (!Util::compareDates($projectData['projStartDate'], $projectData['projEndDate'])) {
		return "627";
	}

	return $projectData;

}




















































?>