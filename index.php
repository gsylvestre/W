<?php

	//you should create a vhost pointing directly inside public/ directory
	//or point your domain there

	//See 'public/' directory
	header('HTTP/1.0 403 Forbidden');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wrong.</title>
</head>
<body>
	<a href="public/">Try here, maybe</a>
</body>
</html>