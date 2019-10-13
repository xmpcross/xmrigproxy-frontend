<?php
//-- Http path of xmrig-remote 
$php_path = "http://xmrigproxy.vpool.space";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$php_path."/php/get_json.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array('cc' => 'write_db')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
?>
