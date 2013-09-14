<?php  

	require_once($_SERVER['DOCUMENT_ROOT'].'/config/init.php');

	$data = '{"data":[{"date":"07/19/2013","status":0,"id":"9","hours":"2","notes":""},{"date":"07/19/2013","status":1,"id":"2","hours":"32","notes":"DoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDoneDone"}]}';

	/*$js = json_decode($data, 1);
	$arr = $js["data"];

	for ($i=0; $i < sizeof($arr); $i++) { 
		echo $arr[$i]["date"]."<br>";
		echo $arr[$i]["status"]."<br>";
		echo $arr[$i]["id"]."<br>";
		echo $arr[$i]["hours"]."<br>";
		echo $arr[$i]["notes"]."<br>";
	}*/



	$db = DB::getInstance();

	echo "<pre>";
	var_dump(Log::enterHours($data));
	echo "</pre>";




	//echo Util::reduceStringSizeTo("Im up all night to get lucky", 10);

	/*$db = DB::getInstance();

	echo "<pre>";
	var_dump($db->getAllProjects());
	echo "</pre>";*/

	/*
	$temp = '[{ "id" : 1, "data": { "name": "Joshua", "status": 1 } }, { "id" : 2, "data": { "name": "Josh", "status": 1 } }, { "id" : 3, "data": { "name": "Frank", "status": 2 } }, { "id" : 4, "data": { "name": "Glenn", "status": 2 } }, { "id" : 5, "data": { "name": "Peter", "status": 1 } }, { "id" : 6, "data": { "name": "Walter White", "status": 2 } }, { "id" : 10, "data": { "name": "sds", "status": 1 } }, { "id" : 11, "data": { "name": "sa", "status": 1 } }, { "id" : 12, "data": { "name": "yos", "status": 2 } }, { "id" : 13, "data": { "name": "ross", "status": 1 } } ]';

	
	$saved = json_decode($temp, 1);

	$clients = json_decode(Clients::saveEditedClients(), 1);*/

	/*echo "<pre>",var_dump($saved),"</pre>";
	echo "<br><br>";*/

	/*foreach ($clients as $client) {
		echo "Name: ".$client["name"]."<br>";
	}*/




	/*for ($i=0; $i < sizeof($clients); $i++) { 

		for ($j=0; $j < sizeof($saved); $j++) { 
			
			if ($clients[$i]["id"] == $saved[$j]["id"]) {

				if (($clients[$i]["name"] != $saved[$j]["data"]["name"]) || ($clients[$i]["status"] != $saved[$j]["data"]["status"])){

					echo $clients[$i]["id"];
				}

			}

		}

	}
*/

	/*$newData = '[{ "id" : 1, "data": { "name": "Joshas", "status": 1 } },{ "id" : 2, "data": { "name": "Josh", "status": 1 } },{ "id" : 3, "data": { "name": "Frank", "status": 2 } },{ "id" : 4, "data": { "name": "Glenn", "status": 1 } },{ "id" : 5, "data": { "name": "Peter", "status": 1 } },{ "id" : 6, "data": { "name": "Walter White", "status": 2 } },{ "id" : 10, "data": { "name": "sds", "status": 1 } },{ "id" : 11, "data": { "name": "sa", "status": 1 } },{ "id" : 12, "data": { "name": "simmy", "status": 2 } },{ "id" : 13, "data": { "name": "ross", "status": 1 } },{ "id" : 14, "data": { "name": "sss", "status": 1 } }]';
	
	$clients = Clients::saveEditedClients($newData);

	var_dump($clients);*/

	/*if ($clients != "525") {
		echo Util::createReturnObject("100", $clients);
	}else{
		echo Util::createReturnObject($clients);
	}*/

	/*$session = session::getInstance();
	$session->set("User", "Ross");
	echo $session->get("User");*/

	/*if (util::validateEmail("gh@google.com")) {
		echo "Valid";
	}else{
		echo "Invalid";
	}*/

	/*$db = DB::getInstance();

	$userData = array(
				"email" 			=> 'tesst@gmail.com',
				"password" 			=> 'test'
			);

	if ($db->loginUser($userData)) {
		echo "Success";
	}else{
		echo "Could not Create";
	}*/

	/*Session::destroy();
	echo Session::get("LoggedIn");*/

	/*$data = User::getUserInfo();
	$obj = json_decode($data, 1);
	var_dump($data);

	echo $obj["userName"];*/

//Session::destroy();

	/* session_start(); 
 print_r ($_SESSION);*/

 	/*$db = DB::getInstance();

	var_dump($db->getStatusOptions("clients"))."<br><br><br><br>";
	var_dump($db->getStatusOptions("projects"))."<br><br><br><br>";
	var_dump($db->getStatusOptions("tasks"))."<br><br><br><br>";*/

	/*$clientData = array(
		"name" 		=> "Jimm",
		"status" 	=> 1
	);

	$clientData = Clients::addClient($clientData);
	var_dump($clientData);*/
?>