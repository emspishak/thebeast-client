<?php

include("common.php");

session_start();

if (!logged_in()) {
	if (!isset($_POST["username"]) || !isset($_POST["password"])) {
		die("Login credentials not sent");	
	}
	$r = new HttpRequest($site_root . '/client_login', HttpRequest::METH_POST);
	$r->addPostFields(array('username' => $_POST["username"], 'password' => $_POST["password"]));
	$r->send();
	echo $r->getResponseBody();
	$response = json_decode($r->getResponseBody());
	if (isset($response->error)) {
		die ("invalid login");	
	}
	$_SESSION["server_session_key"] = $response->session_key;
}

top("Admin Interface");
?>
<h1>Admin Interface</h1>
<p>
	<a href="logout.php">Logout</a>
</p>
<p>
	<?= Logged in as: $_SESSION["server_session_key"] ?>
</p>
<h2>Connect this server to Cinosaurus</h2>
<form method="post" action="connect.php">
	<label>Enter a name for this server: <input type="text" name="client_name" /></label>
	<input type="submit" />
</form>
<?php
bottom();
?>