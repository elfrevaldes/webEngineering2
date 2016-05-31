<?php
	session_start();
	session_destroy();
	header('Location:index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<form class="formcbin" action="index.html" method="post">
			<label>Password</label>
			<input type="text" name="pass" value=""/>
		</form>
	</body>
</html>
