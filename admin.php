<?php

include("common.php");

$r = new HttpRequest($site_root . '/client_login', HttpRequest::METH_POST);
$r->addPostFields(array('username' => $_REQUEST["username"], 'password' => $_REQUEST["password"]));
$r->send();
$response = json_decode($r->getResponseBody());

if (isset($response->error)) {
	die ("invalid login");	
}
$session_start();
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
<h2>Connect this server to Cinosaurus</h2>
<form method="post" action="connect.php">
	<label>Enter a name for this server: <input type="text" name="client_name" /></label>
	<input type="submit" />
</form>
<?php
bottom();
?>