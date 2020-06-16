<?php
function getShortUrlByRealUrl($url) {
	global $conn;
	$stmt = $conn->prepare("select * from short_url where url = ? ");
	$stmt->execute([$url]);
	$result = $stmt->fetchAll();
	if(count($result) > 0) {
		return $result[0]['code'];
	}
	return null;
}

function getShortUrlByCode($code) {
	global $conn;
	$stmt = $conn->prepare("select * from short_url where code = ? ");
	$stmt->execute([$code]);
	$result = $stmt->fetchAll();
	if(count($result) > 0) {
		return $result[0];
	}
	return null;
}

function addNewShortUrl($url, $code) {
	global $conn;
	$stmt = $conn->prepare("insert into short_url (code, url) values (?, ?)");
	$result = $stmt->execute([$code, $url]);
	if(!$result) {
		return false;
	}
	$insert_id =  $conn->lastInsertId();
	return ["code" => $code, "url" => $url, "id" => $insert_id];
}

function addNewLog($id, $client_ip) {
	global $conn;
	$stmt = $conn->prepare("insert into short_url_log (short_url_id, client_ip, logged_at) values (?, ?, ?)");
	$dateTime = new DateTime();
	$logged_at = $dateTime->format('Y-m-d H:i:s');
	$result = $stmt->execute([$id, $client_ip, $logged_at]);
	if(!$result) {
		return false;
	}
	$insert_id =  $conn->lastInsertId();
	return [
		"id" => $insert_id,
		"short_url_id" => $id,
		"client_ip" =>$client_ip,
		"logged_at" => $logged_at
	];
}

function getLogs() {
	global $conn;
	$sql = " select * from short_url_log join short_url on short_url_log.short_url_id = short_url.id ";
	$stmt = $conn->query($sql);
	$result = $stmt->fetchAll();
	return $result;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>