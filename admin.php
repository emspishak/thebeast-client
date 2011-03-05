<?php

include("common.php");

$r = new HttpRequest('http://ec2-75-101-227-4.compute-1.amazonaws.com/client_login', HttpRequest::METH_POST);
$r->addPostFields(array('username' => $_REQUEST["username"], 'password' => $_REQUEST["password"]));
$r->send();
$response = json_decode($r->getResponseBody());
session_start();

$_SESSION["server_session_key"] = $response->session_key;

top("Admin Interface");
?>
	<h1>Admin Interface</h1>
	<p>
		<a href="logout.php">Logout</a>
	</p>
	<p>
		<?= $_SESSION["server_session_key"] ?>
	</p>
<?php
bottom();
?>