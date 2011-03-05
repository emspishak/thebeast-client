<?php

include("common.php");

html_header();

$r = new HttpRequest('http://ec2-75-101-227-4.compute-1.amazonaws.com/client_login', HttpRequest::METH_POST);
$r->addPostFields(array('username' => $_REQUEST["username"], 'password' => $_REQUEST["password"]));
$r->send();
$response = $r->getResponseBody();
?>
	<head>
		<title>Admin Interface</title>
	</head>
	
	<body>
		<h1>Admin Interface</h1>
		<?= $response ?>
	</body>
</html>