<?php
	require_once("./bootstrap.php");
	use PragmaRX\Random\Random;

	$url = isset($_POST['url'])? $_POST["url"] : null;

	if(!$url) {
		echo json_encode(["error" => "Url is required"]);
		exit;
	}

	// check url is already in db
	$short_url = getShortUrlByRealUrl($url);
	if($short_url !== null) {
		echo json_encode(["shortUrl" => BASE_URL."go.php/?code=".$short_url]);
		exit;
	}

	// if not exists in db then create a new url generate new row
	$random = new Random();
	$code = $random->size(5)->get();
	$data = addNewShortUrl($url, $code);
	if(!$data) {
		echo json_encode(["error" => "Something went wrong!"]);
		exit;
	}

	echo json_encode(["shortUrl" => BASE_URL."go.php/?code=".$data["code"]]);

?>