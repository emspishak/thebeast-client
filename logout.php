<?php
$session_key = check_logged_in();

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