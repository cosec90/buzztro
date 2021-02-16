<?php
require('../Admin_config/api_config.php');
require('../razorpay-php/Razorpay.php');
include '../Admin_controllers/booking.php';
include '../Admin_controllers/wallet.php';
session_start();

// $orderId = $_GET['orderId'];
// $quantity = $_GET['quantity'];
// $userId = $_SESSION['user_id'];
// $prodId = $_GET['prodId'];
// $amount = $_GET['amt'];
// $prod_name = $_GET['product'];
// $wallet_amt = $_GET['wallet_amt'];
// $seller_id = $_GET['seller_id'];

// $curl = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => "https://test.cashfree.com/api/v1/order/info/status",
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => "",
// CURLOPT_MAXREDIRS => 10,
// CURLOPT_TIMEOUT => 30,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
// CURLOPT_POSTFIELDS => "appId=".$appIdTest."&secretKey=".$secretKeyTest."&orderId=".$orderId,
// CURLOPT_HTTPHEADER => array(
//     "cache-control: no-cache",
//     "content-type: application/x-www-form-urlencoded"
// ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
// 	echo "cURL Error #:" . $err;
// } else {
// 	$data = json_decode($response, TRUE);

// 	if ($data['txStatus'] == "SUCCESS") 
// 	{


// 		$fetch_wallet = FETCH_USER_WALLET($userId);
// 		$fetch_stock = FETCH_STOCK_DATA($prodId);
// 		$stock = $fetch_stock['stock'];
// 		$sold = $fetch_stock['sold'];
// 		$stock = $stock - $quantity;
// 		$sold = $sold + $quantity;


// 		$update_stock_data = UPDATE_STOCK_DATA($stock,$sold,$prodId);


// 		$add_booking_table = ADD_BOOKING($orderId,$userId,$prod_name,$prodId,$amount,$quantity);


// 		$add_booking_transaction_log = ADD_BOOKING_TRANSACTION_LOG($orderId,$userId,$prod_name,$prodId,$amount,$quantity);



// 		if($wallet_amt != 0){

// 			$new_wallet_amount = $fetch_wallet - $wallet_amt;
// 			$update_wallet = UPDATE_WALLET_PAYMENT($orderId,$new_wallet_amount,$userId);
// 			$add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId,$wallet_amt,$userId);	
// 		}

// 		if($add_booking_transaction_log == true){
// 			echo "<script> 
// 					location.href = '../thankyou.php';      
// 				</script>";

// 		}

// 	}
// 	else
// 	{

// 		header("Location: ../index.php?failed");
// 	}
// }


use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
	$api = new Api($keyId, $keySecret);

	try {
		// Please note that the razorpay order ID must
		// come from a trusted source (session here, but
		// could be database or something else)
		$attributes = array(
			'razorpay_order_id' => $_SESSION['razorpay_order_id'],
			'razorpay_payment_id' => $_POST['razorpay_payment_id'],
			'razorpay_signature' => $_POST['razorpay_signature']
		);

		$api->utility->verifyPaymentSignature($attributes);
	} catch (SignatureVerificationError $e) {
		$success = false;
		$error = 'Razorpay Error : ' . $e->getMessage();
	}
}

if ($success === true) {

	$orderId = $_POST['order_id'];
	$quantity = $_POST['quantity'];
	$userId = $_SESSION['user_id'];
	$prodId = $_POST['prodId'];
	$amount = $_POST['amount'];
	$prod_name = $_POST['product'];
	$wallet_amt = $_POST['wallet_amt'];
	$seller_id = $_POST['seller_id'];


	$fetch_wallet = FETCH_USER_WALLET($userId);
	$fetch_stock = FETCH_STOCK_DATA($prodId);
	$stock = $fetch_stock['stock'];
	$sold = $fetch_stock['sold'];
	$stock = $stock - $quantity;
	$sold = $sold + $quantity;

	$update_stock_data = UPDATE_STOCK_DATA($stock, $sold, $prodId);


	$add_booking_table = ADD_BOOKING($orderId, $userId, $prod_name, $prodId, $amount, $quantity);
	$add_booking_transaction_log = ADD_BOOKING_TRANSACTION_LOG($orderId, $userId, $prod_name, $prodId, $amount, $quantity);

	if ($wallet_amt != 0) {

		$new_wallet_amount = $fetch_wallet - $wallet_amt;
		$update_wallet = UPDATE_WALLET_PAYMENT($orderId, $new_wallet_amount, $userId);
		$add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_amt, $userId);
	}

	if ($add_booking_transaction_log == true) {
		echo "<script> 
					location.href = '../thankyou.php';      
				</script>";
	}
} else {
	echo '<script type="text/javascript">';
	echo 'window.location.href = "../wallet.php?failed";';
	echo '</script>';
}
