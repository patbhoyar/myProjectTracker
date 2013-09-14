<?php  

	spl_autoload_register(function($className) {
		$fileName = dirname(__FILE__) . '/classes/' . $className . '.php';
		if (!file_exists($fileName))
			return false;
		require_once($fileName);
	});

	$domain = "http://ec2-54-241-73-157.us-west-1.compute.amazonaws.com/";
	
?>