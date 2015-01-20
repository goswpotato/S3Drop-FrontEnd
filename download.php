<?php
require('Client.php');
require('GrantType/IGrantType.php');
require('GrantType/AuthorizationCode.php');

const CLIENT_ID     = 'Z.536v4i7?EiwtNG94Xj9lAtTvR_F;Lq3K15?!cd';
const CLIENT_SECRET = 'cSA:KlM5hlfaWghLpd1ITS.qsikK1;UfTaI4ZyIqdp@TOailxGSjk;:nvs!HTWfE8AXk-VBXQ.eT2DD0Zl-1us1NJ-mgfX2svm9EpTKktiKjV@ZgLV.zOwSNfbT0DLxd';

const REDIRECT_URI           = 'https://s3drop.ly2314.com/';
const AUTHORIZATION_ENDPOINT = 'https://oauth.ly2314.cc/oauth/authorize/';
const TOKEN_ENDPOINT         = 'https://oauth.ly2314.cc/oauth/token/';

const SERVER_URI = 'https://lab.ly2314.cc/s3drop';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(!isset($_SESSION['client'])) {
    $client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);
    $client->setAccessTokenType(1); // set access token type to bearer
    if (!isset($_GET['code']))
    {
        $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
        header('Location: ' . $auth_url);
        die('Redirect');
    }
    else
    {
        $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI, 'scope' => 'read write');
        $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
        //parse_str($response['result'], $info);
        //$_SESSION['token'] = $response['result'];
        $token = $response['result'];
        $client->setAccessToken($token['access_token']);
        
        $_SESSION['client'] = $client;
        
        header('Location: https://' . $_SERVER['HTTP_HOST']);
        die('Redirect');

        //$response = $client->fetch('https://graph.facebook.com/me');
        //var_dump($response, $response['result']);
    }
}
else {
    $client = $_SESSION['client'];
}

$path = isset($_GET['path']) ? $_GET['path'] : '';
$get_url = SERVER_URI."/files/" . $path;

$get_response = $client->fetch($get_url, array(), 'GET', array(), 0);
$get = $get_response['result'];
$temp = tempnam(sys_get_temp_dir(), 's3d');
$handle = fopen($temp, "w");
fwrite($handle, $get);
fclose($handle);

$meta_url = SERVER_URI."/metadata/" . $path;

$meta_response = $client->fetch($meta_url, array(), 'GET', array(), 0);
$meta = $meta_response['result'];
//print_r($meta);

$file = substr($path, strrpos($pwd, '/') + 1);
header('Content-Type: '.$meta['mime_type']);
header('Content-Disposition: attachment; filename='.$file);
header('Content-Length: ' . filesize($temp));
readfile($temp);
// do here something

unlink($temp);
?>