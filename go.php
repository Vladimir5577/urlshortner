<?php
	require_once("./bootstrap.php");

	$code = isset($_GET["code"])? $_GET["code"] : null;
	if(!$code) {
		echo "Page not found";
		exit;
	}

	// check url is already in db
	$short_url_data = getShortUrlByCode($code);
	if(!$short_url_data){
		echo "Page not found";
		exit;
	}

	$client_ip = get_client_ip();
	// insert new row in log table 
	$log_data = addNewLog($short_url_data["id"], $client_ip);
	if(!$log_data) {
		echo "Something went wrong!";
		exit;
	}

	header("location: ".$short_url_data["url"]);

?>