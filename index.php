<?php

include("common.php");

html_header();
?>
	<head>
		<title>Cinesaurus Server Administration</title>
	</head>
	
	<body>
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
	</body>
</html>