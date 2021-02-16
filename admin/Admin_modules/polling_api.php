<?php
require('../Admin_config/api_config.php');
include '../Admin_controllers/orders.php';

date_default_timezone_set('Asia/Kolkata');

$order_id = $_GET['id'];
$referenceId = $_GET['refid'];
$url = "https://ecom3stagingapi.vamaship.com/ecom/api/v1/details/".$referenceId;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "Authorization: Bearer ".$log_access_token
));

$response = curl_exec($ch);
curl_close($ch);

//print_r($response);
$jsonDecode = json_decode($response,true);
$key = "documents";
$docs = $jsonDecode[$key];

$invoice = "https://ecom3stagingapi.vamaship.com/ecom/api/v1".$docs['invoices'][0];
$label = "https://ecom3stagingapi.vamaship.com/ecom/api/v1".$docs['labels'][0];
$manifest = "https://ecom3stagingapi.vamaship.com/ecom/api/v1".$docs['manifests'][0];

if ($jsonDecode['success']) {
  $upload_docs = UPLOAD_DOCS($order_id, $invoice, $label, $manifest);
} else
{
  echo "Please reload and try again or contact developer.";
}

?>