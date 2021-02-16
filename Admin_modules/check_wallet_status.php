<?php
include '../Admin_controllers/wallet.php';
require('../Admin_config/api_config.php');

session_start();

require('../razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
	$raz_pay_id = $_POST['razorpay_payment_id'];
	$amt = $_POST['amount'] / 100;
	$userId = $_POST['user_id'];
	$orderId = $_POST['trans_id'];
	$curr_wallet = FETCH_USER_WALLET($userId);
	$newamt = $curr_wallet + $amt;

	$update_wallet = UPDATE_WALLET($orderId,$newamt,$userId);
}
else
{
    echo '<script type="text/javascript">';
    echo 'window.location.href = "../wallet.php?failed";';
    echo '</script>';
}
