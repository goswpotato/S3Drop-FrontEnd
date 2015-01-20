<?php

$client = isset($_SESSION['client']) ? $_SESSION['client'] : null;
$paths = $_POST['paths'];

$results = array();
$delete_url = "https://lab.ly2314.cc/s3drop/fileops/delete";
foreach($paths as $path) {
	$result = $client->fetch($upload_url, array('path' => $path), 'POST', array(), 0);
	array_push($results, $result['result']);
}
