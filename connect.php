<?php

include("common.php");
$session_key = check_logged_in();

$r = new HttpRequest($site_root . "/register_client");
$params = array("session_id" => $session_key, "name" => $_REQUEST["client_name"]);
print_r($params);
$r->addPostFields($params);
$r->send();
$response = json_decode($r->getResponseBody());
print_r($r->getResponseBody());

top("Connect to Cinosaurus");
?>
<h1>Connect to Cinosaurus</h1>
<p>
	UUID: <?= $response->uuid ?>
</p>
<?php
bottom();
?>