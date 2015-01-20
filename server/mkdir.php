<?php

require('../Client.php');
require('../GrantType/IGrantType.php');
require('../GrantType/AuthorizationCode.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$msg = '';

$client = isset($_SESSION['client']) ? $_SESSION['client'] : null;
$path = $_POST['path'];

$mkdir_url = "https://lab.ly2314.cc/s3drop/fileops/create_folder";
$result = $client->fetch($mkdir_url, array('path' => $path), 'POST', array(), 0);
	
print_r($result);

?>