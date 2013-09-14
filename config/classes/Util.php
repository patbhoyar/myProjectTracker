<?php  

	/**
	 * This class is the responsible for all the Misc Utilities 
	 *
	 * @copyright  2012  
	 * @license    http://www. .com
	 * @version    Release: @package_version@
	 * @link       http://www. .com
	 * @since      Class available since Release 1.0
	 */ 
	class Util
	{ 
	    private static $instance; 

	    /**
		 * Constructs an Instance of the Util class
		 *
		 */ 
	    private function __construct() {} 

	    /**
		 * Creates a Singleton Object of the Util Class
		 *
		 * @return Singleton Object of the Util Class
		 */ 
	    public static function getInstance(){ 
	        if (!self::$instance){ 
	            self::$instance = new Util(); 
	        } 
	        return self::$instance; 
	    } 

	    /**
		 * Send out multiple emails
		 *
		 * @param  String 	$email  -	The list of emails to be sent out to 
		 * @return true or false
		 */ 
	    public function sendEmail($emails){
	    	$to = "";
			$subject = "Hi!";
			$headers = 'From: XXX<invite@xxx.com>' . "\r\n" .
					   'Bcc: '. $emails . "\r\n" .
					   'Reply-To: contact@xxx.com' . "\r\n" .
					   'X-Mailer: PHP/' . phpversion();
			$body = "Hi,\n\nHow are you?";
			if (mail($to, $subject, $body, $headers)) {
			  return true;
			} else {
			  return false;
			}
	    }

	    public static function randomString($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, strlen($characters) - 1)];
		    }
		    return $randomString;
		}

		public static function validateEmail($email){
		    
		    $isValid = true;
		    $atIndex = strrpos($email, "@");
		    if (is_bool($atIndex) && !$atIndex){
		        $isValid = false;
		    } else {

		        $domain    = substr($email, $atIndex + 1);
		        $local     = substr($email, 0, $atIndex);
		        $localLen  = strlen($local);
		        $domainLen = strlen($domain);
		        if ($localLen < 1 || $localLen > 64){
		            $isValid = false;
		        } else if ($domainLen < 1 || $domainLen > 255){
		            $isValid = false;
		       	} else if ($local[0] == '.' || $local[$localLen - 1] == '.'){
		            $isValid = false;
		        } else if (preg_match('/\\.\\./', $local)) {
		            $isValid = false;
		        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
		            $isValid = false;
		        } else if (preg_match('/\\.\\./', $domain)) {
		            $isValid = false;
		        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
		            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
		                $isValid = false;
		            }
		        }
		        if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) {
		            $isValid = false;
		        }
		    }
		    return $isValid;
		}

		public static function createReturnObject($returnCode, $message = null){

			require($_SERVER['DOCUMENT_ROOT'].'/config/en.php');

			/*var_dump($returnCode);
			echo "<pre>".var_dump($retunCodes)."</pre>";
			echo $retunCodes[$returnCode];
*/
			if ($returnCode != "100") {
				$obj = array(
					"code"		=> 	"500",
					"message"	=> 	$retunCodes[$returnCode]
				);
			}else{

				if (!is_null($message)) {
					$theMessage = $message;
				}else{
					$theMessage = $retunCodes[$returnCode];
				}

				$obj = array(
					"code"		=> 	"100",
					"message"	=> 	$theMessage
				);
			}

			return json_encode($obj);
		}

		public static function compareDates($date1, $date2){

			$datetime1 = new DateTime($date1);
			$datetime2 = new DateTime($date2);

			return ($datetime1 <= $datetime2);

		}

		public static function reduceStringSizeTo($string, $newSize){

			if (strlen($string) >= $newSize+2) {
				return substr($string, 0, $newSize)."...";
			}else{
				return $string;
			}

		}

	}  

 ?>