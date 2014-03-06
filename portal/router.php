<?php
include 'config/config.inc';

$file = ltrim($_SERVER['REQUEST_URI'], '/');
$session = SSession::instance();
if (!$session->get(SSession::$AUTHINDEX)) {
	global $account_url;
	header('Location: '.$account_url.'?service=security&redirect_uri='.urlencode($file));
}
$file = parseGetparams($file).'.php';

include '../dao/config/config.inc';

date_default_timezone_set('America/Vancouver');

if (file_exists($file)) {
	include $file;
} else if ($file=='index.php' || $file=='.php') {
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