<?php

include("common.php");

session_start();

if (!logged_in()) {
	if (!isset($_POST["username"]) || strlen($_POST["username"]) == 0 || !isset($_POST["password"]) || strlen($_POST["password"]) == 0) {
		die("Missing so login credentials");	
	}
	$params = array('username' => $_POST["username"], 'password' => $_POST["password"]);
	$response = post('/client_login', $params);
	
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
	Logged in as: <?= $_SESSION["server_session_key"] ?>
</p>
<h2>Connect this server to Cinosaurus</h2>
<form method="post" action="connect.php">
	<label>Enter a name for this server: <input type="text" name="client_name" /></label>
	<input type="submit" />
</form>
<?php
bottom();
?>