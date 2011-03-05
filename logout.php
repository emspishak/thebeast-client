<?php
session_start();
$session_key = $_SESSION["server_session_key"];
session_destroy();
include("common.php");
top("Logout");
?>
	<p>
		You are logged out of session <?= $session_key ?>.
	</p>
<?php
bottom();
?>