<?php
$site_root = "http://ec2-75-101-227-4.compute-1.amazonaws.com";

function top($name) {
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title><?= $name ?></title>
		</head>
		<body>
	<?php
}

function bottom() {
	?>
		</body>
	</html>
	<?php	
}

function logged_in() {
	return isset($_SESSION["server_session_key"]);	
}

function check_logged_in() {
	session_start();
	if (!logged_in()) {
		die("You can't be here! You aren't logged in!");	
	} else {
		return $_SESSION["server_session_key"];
	}
}

function post($page, $params, $json=TRUE) {
	global $site_root;
	
	$r = new HttpRequest($site_root . $page, HttpRequest::METH_POST);
	$r->addPostFields($params);
	$r->send();
	echo $r->getResponseBody();
	if ($json) {
		return json_decode($r->getResponseBody());
	} else {
		return $r->getResponseBody();	
	}
}
?>