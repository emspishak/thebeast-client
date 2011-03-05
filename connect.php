<?php

include("common.php");
$session_key = check_logged_in();

$params = array('session_id' => $session_key, 'name' => $_REQUEST["client_name"]);
$response = post("/register_client", $params);

insert_uuid($response->uuid);

top("Connect to Cinosaurus");
?>
<h1>Connect to Cinesaurus</h1>
<p>
	You have successfully been connected to Cinesaurus with a UUID of: <?= get_uuid() ?>
</p>
<form method="post" action="upload.php">
	<label>Directory movies are located in: <input type="text" name="directory" /></label>
	<input type="submit" />
</form>
<?php
bottom();
?>