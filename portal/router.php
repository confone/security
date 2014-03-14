<?php
include 'config/config.inc';

$uri = ltrim($_SERVER['REQUEST_URI'], '/');

$session = SSession::instance();
$_ACCOUNTID = $session->get(SSession::$AUTHINDEX);
if (!$_ACCOUNTID&&false) {
	global $account_url;
	header('Location: '.$account_url.'?service=security&redirect_uri='.urlencode($uri));
}

include '../dao/config/config.inc';

date_default_timezone_set('America/Vancouver');

// if $uri is set add .php ot its end for include as file name
//
if (!empty($uri)) {
	$uri = parseGetparams($uri);
}

if (file_exists($uri) && !is_dir($uri)) {
	include $uri;
} else if (empty($uri) || $uri=='index.php') {
	include 'application/index.php';
} else {
	include 'include/404.php';
}


function parseGetparams($uri) {
    $gets = explode('?', $uri, 2);

    $getParams = explode('&', $gets[1]);
    foreach ($getParams as $getParam) {
        $pair = explode('=', $getParam, 2);
        if (sizeof($pair)==2) {
            $_GET[$pair[0]] = $pair[1];
        }
    }

    return $gets[0];
}
?>