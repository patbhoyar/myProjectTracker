<?php  

class Clients
{ 
    /**
	 * Get Clients Status Options
	 *
	 * @return json object of Clients Status Options
	 */ 
    public static function getClientStatusOptions(){

		$database = DB::getInstance();

		if ($statusOptions = $database->getStatusOptions("clients")) {
			return $statusOptions;
		}else{
			return "521";
		}
    }

    /**
	 * Insert Client
	 *
	 * @return json object of Clients 
	 */ 
    public static function addClient($clientData){

		$database = DB::getInstance();

		if ($clientList = $database->addClient($clientData)) {
			return $clientList;
		}else{
			return "522";
		}
    }

    /**
	 * Get All Clients
	 *
	 * @return json object of Clients 
	 */ 
    public static function getAllClients(){

		$database = DB::getInstance();

		if ($clientList = $database->getAllClients()) {
			return $clientList;
		}else{
			return "522";
		}
    }

    /**
	 * Get Projects for Client with Id
	 *
	 * @return json object of Client
	 */ 
    public static function getProjectsForClientWithId($id){

		$database = DB::getInstance();

		if ($clientInfo = $database->getProjectsForClientWithId($id)) {
			return $clientInfo;
		}else{
			return "526";
		}
    }

    /**
	 * Save Edited Clients
	 *
	 * @return json object of Clients 
	 */ 
    public static function saveEditedClients($clientNewData){

    	$database = DB::getInstance();
    	$clientNewData = json_decode($clientNewData, 1);
		$clients = json_decode(self::getAllClients(), 1);

    	for ($i=0; $i < sizeof($clients); $i++) { 
			for ($j=0; $j < sizeof($clientNewData); $j++) { 
				
				if ($clients[$i]["id"] == $clientNewData[$j]["id"]) {

					if (($clients[$i]["name"] != $clientNewData[$j]["data"]["name"]) || ($clients[$i]["status"] != $clientNewData[$j]["data"]["status"])){

						$clientData = array(
							'id' => $clients[$i]["id"], 
							'name' => $clientNewData[$j]["data"]["name"], 
							'status' => $clientNewData[$j]["data"]["status"], 
						);

						if (!$database->saveEditedClients($clientData)) {
							return "525";
						}
					}
				}
			}
		}

    	$clients = self::getAllClients();
    	return $clients;
    }


   

}


?>