<?php  

class User
{ 
    /**
	 * Create New User
	 *
	 * @param  String 	$name  		-	The user's name
	 * @param  String 	$email  	-	The user's email
	 * @param  String 	$password  	-	The user's password
	 * @return true or false
	 */ 
    public static function createUser($userData){

    	if ($userData["password"] != $userData["confirmPassword"]) {
    		return "502";
    	}else if(!Util::validateEmail($userData["email"])) {
    		return "503";
    	}else{

    		$database = DB::getInstance();

    		if ($database->createNewUser($userData)) {
    			return "100";
    		}else{
    			return "501";
    		}
    	}
    }

    /**
     * Login User
     *
     * @param  String   $email      -   The user's email
     * @param  String   $password   -   The user's password
     * @return true or false
     */ 
    public static function loginUser($userData){

        $database = DB::getInstance();

        if ($database->loginUser($userData)) {
            return "100";
        }else{
            return "504";
        }
    }

    /**
     * Check If User is Logged In
     *
     * @return true or false
     */ 
    public static function isUserLoggedIn(){

        $loggedIn = Session::get("LoggedIn");

        if (isset($loggedIn)) {
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Get User Info by Email
     *
     * @return json encoded object of user data
     */ 
    public static function getUserInfo(){

        $email = Session::get("LoggedIn");
        $database = DB::getInstance();

        if ($userData = $database->getUserInfo($email)) {
            return $userData;
        }else{
            return "505";
        }
    }

    /**
     * Get All Users
     *
     * @return json encoded object of users
     */ 
    public static function getAllUsers(){

        $database = DB::getInstance();

        if ($userData = $database->getAllUsers()) {
            return $userData;
        }else{
            return "506";
        }
    }

}


?>