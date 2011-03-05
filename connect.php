<?php

include("common.php");
$session_key = check_logged_in();

$params = array('session_id' => $session_key, 'name' => $_REQUEST["client_name"]);
$response = post("/register_client", $params);

insert_uuid($response->uuid);

top("Connect to Cinosaurus");
?>
<h1>Connect to Cinosaurus</h1>
<p>
	UUID: <?= get_uuid() ?>
</p>
<?php
bottom();
?>