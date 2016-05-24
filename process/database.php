<?php
	require('settings.php');
	function dbConnect()
	{
		$dbName='php';

		$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
		if ($openShiftVar === null || $openShiftVar == "")
		{
			// Not in the openshift environment
			$dbHost = "127.4.13.130";
			$dbUser = getLocalUser();
			$dbPassword = getLocalPass();
		}
		else
		{
			// In the openshift environment
			$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
			$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
			$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
			$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		}
		try {
			$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
		} catch (Exception $ex) {
			echo 'Error!: ' . $ex->getMessage();
			die(); // we always include a die after redirects
		}
		return $db;
	}
?>
