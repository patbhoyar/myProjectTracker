<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/config/init.php');

	if ($loginRequired) {
		if (!User::isUserLoggedIn()) {
			header("Location: login.php");
		}else{
			if (Session::get("userType") == 1) {
				if (__FILE__ != "/var/www/admin.php") {
					header("Location: ".$domain."admin.php");
				}
			}
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />	
	<title><?php echo $title?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
	<script src="/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<?php
	if (isset($js)) {
		$arr = explode(',', $js);
		foreach($arr as $item)
			echo("\t<script src=\"/js/" . trim($item) . "\" type=\"text/javascript\"></script>\r\n");
	}

	if (isset($css)) {
		$arr = explode(',', $css);
		foreach($arr as $item)
			echo("\t<link rel=\"stylesheet\" href=\"/css/" . trim($item) . "\" type=\"text/css\"/>\r\n");
	}
?>

</head>
<body>
	<div id="mainContainer">