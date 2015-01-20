<?php

require('../Client.php');
require('../GrantType/IGrantType.php');
require('../GrantType/AuthorizationCode.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$msg = '';

$client = isset($_SESSION['client']) ? $_SESSION['client'] : null;
$paths = $_POST['paths'];

$delete_url = "https://lab.ly2314.cc/s3drop/fileops/delete";
foreach($paths as $path) {
	$result = $client->fetch($delete_url, array('path' => $path), 'POST', array(), 0);
	
	print_r($result);
}


?>