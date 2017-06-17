<?php
/**
 * 获取当前最新的版本状态，以便提示客户端升级
 * @author dogstar 20170617
 */

$version = isset($_REQUEST['version']) ? $_REQUEST['version'] : '1.0.0';
$lastestVersion = '1.4.1';

$rs = array(
    'ret' => 200,
    'data' => array(
        'version' => $lastestVersion,
		'need_upgrade' => version_compare($version, $lastestVersion),
        'url' => 'https://www.phalapi.net/download.html',
    ),
    'msg' => '',
);

header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求  
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); 
header( "Access-Control-Allow-Methods:POST,GET" );

header('Content-type: application/json');

echo json_encode($rs);
