<?php  

	$retunCodes = array(
		"100"	=> 	"Success",
		"101"	=>	"Successfully Created New User",
		"501"	=> 	"Could not Create a new User",
		"502"	=> 	"Passwords must Match",
		"503"	=> 	"Invalid Email",
		"504"	=>	"Username/Password Incorrect",
		"505"	=> 	"User not Found",
		"506"	=>  "Could not retreive User List",



		"521"	=> "Could not retreive Client Status Options",
		"522"	=> "Could not retreive Client List",
		"523"	=> "Please Enter a Client name",
		"524"	=> "",
		"525"	=> "Could not save client changes",
		"526"	=> "Client Info not found",


		"621"	=> "Could not retreive Project Status Options",
		"622"	=> "Could not retreive Project List",
		"623"	=> "There seem to be some missing fields. Please Enter complete information about the Project",
		"624"	=> "Only Numbers for Project Estimated Hours",
		"625"	=> "Could not retreive Project Type Options",
		"626"	=> "Only Numbers for Project Budget",
		"627"	=> "Project StartDate must be before EndDate",
		"628"	=> "Coudnt Insert Project",
		"629"	=> "Coudnt retreive Project",
		"630"	=> "Coudnt save Project",
		"631"	=> "No Projects for Current Client.",


		"721" 	=> "Could not retreive Task Status Options",
		"722"	=> "Could not retreive Task Types",
		"723"	=> "Could not save edited Task",
		"724"	=> "Could not retreive Client Priorities",
		"725"	=> "There seem to be some missing fields. Please Enter complete information about the Task",
		"726"	=> "Please select a Project for this Task.",
		"727"	=> "Please select a Task Type.",
		"728"	=> "Coudnt Insert Task",
		"729"	=> "Please select a User to Assign this Task to.",
		"730"	=> "Please select the Task Priority.",
		"731"	=> "Could not retrieve Tasks for Current User",
		"732"	=> "No Tasks for Current Project",
		"733"	=> "Please enter a Completion Date",
		"734"	=> "Please enter the Hours to Completion",
		"735"	=> "Only Numbers for Estimated Hours",
		"736"	=> "Only Numbers for Hours to Completion",
		"737"	=> "The requested task does not exist!",
		"738"	=> "Could not retreive Tasks",
		"739"	=> "Could not retreive Tasks Types for Project",

		"821"	=> "Could not save the Logged Hours.",
		"822"	=> "No Logs for given date",



		"900"	=> 	"test"
	);

	$sizes = array(
		'MAX_PROJECT_NAME_SIZE' => 18, 
		'MAX_CLIENT_NAME_SIZE' => 18, 
		'MAX_NOTES_SIZE' => 18,
		'MAX_PROJECT_TYPE_SIZE' => 7,
		'MAX_PROJECT_STATUS_SIZE' => 10,
		'MAX_TASK_NOTES_SIZE' => 27
	);

