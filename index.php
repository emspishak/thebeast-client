<?php

include("common.php");
session_create();
if (logged_in()) {
	header("Location: " . $site_root);
}

top("Cinesaurus Server Administration");
?>	
<h1>Cinesaurus Server Administration</h1>
<h2>Log in with your Cinesaurus account</h2>
<form method="POST" action="admin.php">
	<label>User name:<input type="text" name="username" /></label>
	<label>Password:<input type="password" name="password" /></label>
	<input type="submit" />
</form>
<p>
	Don't have a Cenosaurus account yet? Click <a href="">here</a> to sign up!
</p>
<?php
bottom();
?>