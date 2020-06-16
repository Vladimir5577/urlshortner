<?php
	try {
		$conn = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASSWORD);
	} catch (PDOException $error) {
		echo "Connection Failed" . $error->getMessage();
	}
?>