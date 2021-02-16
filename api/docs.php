<?php
require('../Admin_config/api_config.php');

date_default_timezone_set('Asia/Kolkata');

$URL = $_GET['url'];
$path = "./test.pdf";
$file_download= curl_init();

curl_setopt($file_download, CURLOPT_URL, $URL);
curl_setopt($file_download, CURLOPT_RETURNTRANSFER, true);
curl_setopt($file_download, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($file_download, CURLOPT_AUTOREFERER, true);
curl_setopt($file_download, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "Authorization: Bearer ".$log_access_token
));
$result= curl_exec($file_download);
file_put_contents($path, $result);
?>
