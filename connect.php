<?php

include("common.php");
$session_key = check_logged_in();

$r = new HttpRequest($site_root . "/register_client");
$r->addPostFields(array("session_id" => $session_key, "name" => $_REQUEST["client_name"]));
$r->send();
$response = json_decode($r->getResponseBody());

top("Connect to Cinosaurus");
?>
<h1>Connect to Cinosaurus</h1>
<p>
	UUID: <?= $response->uuid ?>
</p>
<?php
bottom();
?>