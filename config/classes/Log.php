<?php  

class Log
{ 

	public static function enterHours($data){
		$database = DB::getInstance();
		if ($database->enterHours($data)) {
			return "100";
		}else{
			return "821";
		}
	}

	public static function getTasksForDate($date){
		$database = DB::getInstance();
		if ($tasks = $database->getTasksForDate($date)) {
			return $tasks;
		}else{
			return "822";
		}
	}

}
?>