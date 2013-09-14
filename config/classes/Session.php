<?php

	/**
 	*This class is the responsible for all the Session Utilities 
	*
	* @copyright  2012  
	* @license    http://www. .com
	* @version    Release: @package_version@
	* @link       http://www. .com
	* @since      Class available since Release 1.0
 	*/
class Session  {
	
	private static $_instance;

	private function __construct() {
		ob_start();
		ini_set('session.cookie_httponly', true);
		session_set_cookie_params(0, '/', 'ec2-54-241-73-157.us-west-1.compute.amazonaws.com');
		session_start();
	}
	
	public static function getInstance() {
		try {
			if (!isset(self::$_instance))
				self::$_instance = new Session();
		}
		catch (exception $exc) {}
		return self::$_instance;
	}

	/**
	 * Returns the id of the current session
	 *
	 * @return mixed The id of the current session
	 */	
	public static function getId() {
		$instance = self::getInstance();
		return session_id();
	}
	/**
	 * Gets the value of a key from the session storage
	 *
	 * @param string $key Key
	 * @return mixed The value of the given key
	 */	
	public static function get($key) {
		$instance = self::getInstance();
		return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
	}
	/**
	 * Sets the value of a key in the session storage
	 *
	 * @param mixed $key Key
	 * @param mixed $value The value of the given key
	 */	
	public static function set($key, $value) {
		$instance = self::getInstance();
		$_SESSION[$key] = $value;
	}
	/**
	 * Resets and clears the session storage
	 */	
	public static function destroy() {
		$instance = self::getInstance();

		setcookie(session_id(), "", time() - 3600, '/', 'ec2-54-241-73-157.us-west-1.compute.amazonaws.com');
	    setcookie(' ', "", time() - 3600, '/', 'ec2-54-241-73-157.us-west-1.compute.amazonaws.com'); 
		session_destroy();
		session_write_close();
	}
}
?>