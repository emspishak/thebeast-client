<?php
include("common.php");

$session_key = check_logged_in();

unset($_SESSION["server_session_key"]);
session_destroy();

top("Logout");
?>
<p>
	You are logged out of session <?= $session_key ?>.
</p>
<?php
bottom();
?>