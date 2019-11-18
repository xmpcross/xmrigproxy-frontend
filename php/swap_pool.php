<?php

header('Content-Type: application/json');
error_reporting(0);

$_POST['cc'] = 'dummy';
require('get_json.php');

if (!isset($_REQUEST['token']) || $_REQUEST['token'] != $app_password) die;

#echo "disabled\n"; return;

$proxy_id = intval($_REQUEST["proxy"]);
$proxy = $proxy_list[$proxy_id];
$proxy_config_data = get_proxy_configs($proxy["ip"], $proxy["port"], $proxy["token"]);

if($proxy_config_data && sizeof($proxy_config_data["pools"]) > 1) {
	$prev_pool = $proxy_config_data["pools"][0];
	unset($proxy_config_data["pools"][0]);
	array_push($proxy_config_data["pools"], $prev_pool);
	$proxy_config_data["pools"] = array_values($proxy_config_data["pools"]);

	$response = write_config("http://".$proxy["ip"].":".$proxy["port"]."/1/config", $proxy_config_data, $proxy["token"]);
	echo json_encode(array("success"=>true, "proxy"=>$proxy["ip"].":".$proxy["port"], "new_pool"=>$proxy_config_data["pools"][0], "prev_pool"=>$prev_pool), JSON_PRETTY_PRINT)."\n";
}

?>
