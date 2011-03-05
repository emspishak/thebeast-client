<?php

include("common.php");

html_header();

$r = new HttpRequest('index.php', HttpRequest::METH_POST);
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