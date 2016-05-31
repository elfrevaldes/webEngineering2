<?php
	function dbConnect()
	{
		$dbName='php';
		$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
		if ($openShiftVar === null || $openShiftVar == "")
		{
			require('settings.php'); // need for credentials
			// Not in the openshift environment
			//$dbHost = "127.4.13.130";
			$dbHost = "127.0.0.1";
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

	function sanitizeInput($word)
   {
     $result = htmlspecialchars($word);
     $result = strip_tags($result);
     $result = stripcslashes($result);
     //$result = mysqli_real_escape_string($result);
     return $result;
   }
?>
