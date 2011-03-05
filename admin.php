<?php

include("common.php");

$r = new HttpRequest('http://ec2-75-101-227-4.compute-1.amazonaws.com/client_login', HttpRequest::METH_POST);
$r->addPostFields(array('username' => $_REQUEST["username"], 'password' => $_REQUEST["password"]));
$r->send();
$response = json_decode($r->getResponseBody());
session_start();

$_SESSION["server_session_key"] = $response->session_key;

html_header();
?>
	<head>
		<title>Admin Interface</title>
	</head>
	
	<body>
		<h1>Admin Interface</h1>
		<?= $_SESSION["server_session_key"] ?>
	</body>
</html>