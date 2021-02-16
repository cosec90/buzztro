<?php
require('../Admin_config/api_config.php');
include '../Admin_controllers/orders.php';

date_default_timezone_set('Asia/Kolkata');

$order_id = $_GET['id'];

$order_details = FETCH_ORDERS_DETAILS($order_id);

// echo "<pre>";
// print_r($order_details);
// echo "</pre>";

$date = date('c');
$date1 = str_replace('-', '/', $date);
$next = date('c',strtotime($date1 . "+1 days"));

// //Seller Details
// echo "<br>";
// echo "Company address: ".$company_addr = $order_details['company_addr'];
// echo "<br>";
// echo "Seller city: ". $seller_city = $order_details['seller_city'];
// echo "<br>";
// echo "Seller Mail: ". $seller_mail = $order_details['mail_id'];
// echo "<br>";
// echo "Seller Name: ". $seller_name = $order_details['seller_name'];
// echo "<br>";
// echo "Seller mobile: ". $seller_mobile = $order_details['mob_no'];
// echo "<br>";
// echo "Seller pincode: ". $seller_pincode = $order_details['seller_pincode'];
// echo "<br>";
// echo "Seller state: ". $seller_state = $order_details['seller_state'];
// echo "<br>";

// //User Details
// echo "Delivery address: ". $delivery_address = $order_details['delivery_address'];
// echo "<br>";
// echo "User city: ". $user_city = $order_details['city'];
// echo "<br>";
// echo "User mail: ". $user_mail = $order_details['user_mail'];
// echo "<br>";
// echo "User name: ". $user_name = $order_details['user_name'];
// echo "<br>";
// echo "User mobile: ". $user_mob = $order_details['user_mob'];
// echo "<br>";
// echo "User pincode: ". $user_pincode = $order_details['pincode'];
// echo "<br>";
// echo "Product: ". $prod_name = $order_details['prod_name'];
// echo "<br>";
// echo "Amount: ". $order_amt = $order_details['order_amt'];
// echo "<br>";
// echo "Quantity: ". $order_quantity = $order_details['order_quantity'];
// echo "<br>";
// echo "User state: ". $user_state = $order_details['state'];
// echo "<br>";
// echo "is cod: ". $is_cod = $order_details['payment_status'];
// echo "<br>";
// echo "weight: ". $weight = $order_details['weight'];
// echo "<br>";
// echo "length: ". $length = $order_details['length'];
// echo "<br>";
// echo "breadth: ". $breadth = $order_details['breadth'];
// echo "<br>";
// echo "height: ". $height = $order_details['height'];
// echo "<br>";
// echo "unit: ". $unit = $order_details['unit'];
// echo "<br>";
// echo "<br>";
//Seller Details
$company_addr = $order_details['company_addr'];
$seller_city = $order_details['seller_city'];
$seller_mail = $order_details['mail_id'];
$seller_name = $order_details['seller_name'];
$seller_mobile = $order_details['mob_no'];
$seller_pincode = $order_details['seller_pincode'];
$seller_state = $order_details['seller_state'];

//User Details
$delivery_address = $order_details['delivery_address'];
$user_city = $order_details['city'];
$user_mail = $order_details['user_mail'];
$user_name = $order_details['user_name'];
$user_mob = $order_details['user_mob'];
$user_pincode = $order_details['pincode'];
$prod_name = $order_details['prod_name'];
$order_amt = $order_details['order_amt'];
$order_quantity = $order_details['order_quantity'];
$user_state = $order_details['state'];
$is_cod = $order_details['payment_status'];
$weight = $order_details['weight'];
$length = $order_details['length'];
$height = $order_details['height'];
$breadth = $order_details['weight'];
$unit = $order_details['unit'];


$postfields = array(
   'seller' => array(
      "address" => $company_addr,
      "city" => $seller_city,
      "country" => "India",
      "email" => $seller_mail,
      "name" => $seller_name,
      "phone" => $seller_mobile,
      "pincode" => $seller_pincode,
      "state" => $seller_state,
   ),
   'shipments' => [
      array(
          "gst_tin" => "",
          "hsn_code" => "",
          "address" => $delivery_address,
          "breadth" => $breadth,
          "city" => $user_city,
          "country" => "India",
          "email" => $user_mail,
          "height" => $height,
          "is_cod" => (bool)$is_cod,
          "length" => $length,
          "name" => $user_name,
          "phone" => $user_mob,
          "pickup_date" => $next,
          "pincode" => $user_pincode,
          "product" => $prod_name,
          "product_value" => $order_amt,
          "quantity" => $order_quantity,
          "reference1" => "",
          "reference2" => "",
          "state" => $user_state,
          "unit" => $unit,
          "weight" => $weight,
          "cargo_type" => "general",
          "liability" => "no"
     )]
);

//echo json_encode($postfields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://ecom3stagingapi.vamaship.com/ecom/api/v1/dom/book");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postfields));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "Authorization: Bearer ".$log_access_token
));

$response = curl_exec($ch);
curl_close($ch);

$jsonDecode = json_decode($response,true);
$key = "refid";
$status = "success";
$refid = $jsonDecode[$key];

if ($jsonDecode[$status] == 1 && $refid != 0) {
  //echo $refid;

  $update_order = UPDATE_ORDER($order_id, $refid);
}

?>