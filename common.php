<?php
function header($name) {
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title><?= $name ?></title>
		</head>
		<body>
	<?php
}

function footer() {
	?>
		</body>
	</html>
	<?php	
}
?>