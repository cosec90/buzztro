<?php
require('../Admin_config/api_config.php');
require('../razorpay-php/Razorpay.php');
include '../Admin_controllers/products.php';
include '../Admin_controllers/order.php';
include '../Admin_controllers/wallet.php';
include '../Admin_controllers/booking.php';

use Razorpay\Api\Api;

session_start();

if (isset($_POST['btnSubmit'])) {
    $userid = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
    $mail = $_SESSION['user_mail'];
    $mob = $_SESSION['user_mob'];
    $prod_id = $_POST['product_id'];
    $amt = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $prod_name = $_POST['prod_name'];
    $prod_order_id = $_POST['order_id'];
    $address = $_POST['add1'];
    $seller_id = $_POST['seller_id'];
    $wallet_amt = $_POST['wallet_amt'][0];
    $payemnt_option = $_POST['payment'];
    // echo $prod_order_id;
    // echo "<br>";
    // echo $prod_name;
    // echo "<br>";
    // echo $amt;
    // echo "<br>";
    // echo $prod_id;
    // echo "<br>";
    // echo $quan;
    // if ($wallet_amt == null) {
    //     $wallet_amt = 0;
    // }
  
}

if ($payemnt_option == 'cash') {

    //COD transaction start

    if ($amt == 0 && $wallet_amt != 0) {

        //completed successfully


        $wallet_transaction_amt = $fetch_wallet - $wallet_amt;

        if ($wallet_transaction_amt == 0) {
            $wallet_transaction_amt =  $wallet_amt;
            $wallet_amt = $wallet_amt - $wallet_transaction_amt;
            // echo $wallet_transaction_amt;
        }
        // echo $wallet_transaction_amt;

        // echo $wallet_amt;

        $orderId =  "BKORDER" . strtoupper(substr(uniqid(), 0, 10));

        $update_wallet = UPDATE_WALLET_PAYMENT($orderId, $wallet_amt, $userid);
        $add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_transaction_amt, $userid);

        //add prder transaction and change status
        $update_payment_status = UPDATE_PAYMENT_STATUS($prod_order_id);
        $add_order = ADD_ORDER($orderId, $seller_id, $prod_name, $prod_order_id, $wallet_amt, $quantity, $address, $payemnt_option);
        $add_order_transaction = ADD_ORDER_TRANSACTION($orderId, $wallet_amt);


        echo "<script> 
                        location.href = '../thankyou.php';      
                    </script>";
    } else if ($amt == 0 && $wallet_amt == 0) {

        //completd successfully


        // echo $wallet_amt;
        // echo "<br>";
        // echo $amt;
        // echo "Inside 2 if";

        $orderId =  "BKORDER" . strtoupper(substr(uniqid(), 0, 10));
        $wallet_transaction_amt = $fetch_wallet;


        $update_wallet = UPDATE_WALLET_PAYMENT($orderId, $wallet_amt, $userid);
        $add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_transaction_amt, $userid);


        //add prder
        $update_payment_status = UPDATE_PAYMENT_STATUS($prod_order_id);
        $add_order = ADD_ORDER($orderId, $seller_id, $prod_name, $prod_order_id, $amt, $quantity, $address, $payemnt_option);
        $add_order_transaction = ADD_ORDER_TRANSACTION($orderId, $amt);

        if ($add_order_transaction == true) {
            echo "<script> 
                        location.href = '../thankyou.php';      
                    </script>";
        }
    } else {

        // echo "Inside Main";
        $add_order = ADD_ORDER($orderId, $seller_id, $prod_name, $prod_order_id, $amt, $quantity, $address, $payemnt_option);
        $add_order_transaction = ADD_ORDER_TRANSACTION($orderId, $amt);
        $fetch_wallet = FETCH_USER_WALLET($userid);

        if ($wallet_amt != 0) {

            $new_wallet_amount = $fetch_wallet - $wallet_amt;
            $update_wallet = UPDATE_WALLET_PAYMENT($orderId, $new_wallet_amount, $userid);
            $add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_amt, $userid);
        }

        if ($add_order_transaction == true) {

            $update_payment_status = UPDATE_PAYMENT_STATUS($prod_order_id);
            echo "<script> 
					location.href = '../booking.php';      
				</script>";
        }
    }

    //end offline payment

    //COD transaction end
} else {
   
    //online transaction

    if ($amt == 0 && $wallet_amt != 0) {

        //completed successfully


        $wallet_transaction_amt = $fetch_wallet - $wallet_amt;

        if ($wallet_transaction_amt == 0) {
            $wallet_transaction_amt =  $wallet_amt;
            $wallet_amt = $wallet_amt - $wallet_transaction_amt;
            // echo $wallet_transaction_amt;
        }
        // echo $wallet_transaction_amt;

        // echo $wallet_amt;

        $orderId =  "BKORDER" . strtoupper(substr(uniqid(), 0, 10));

        $update_wallet = UPDATE_WALLET_PAYMENT($orderId, $wallet_amt, $userid);
        $add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_transaction_amt, $userid);

        //add prder transaction and change status
        $update_payment_status = UPDATE_PAYMENT_STATUS($prod_order_id);
        $add_order = ADD_ORDER($orderId, $seller_id, $prod_name, $prod_order_id, $wallet_amt, $quantity, $address, $payemnt_option);
        $add_order_transaction = ADD_ORDER_TRANSACTION($orderId, $wallet_amt);


        echo "<script> 
                        location.href = '../thankyou.php';      
                    </script>";
    } else if ($amt == 0 && $wallet_amt == 0) {

        //completd successfully


        $orderId =  "BKORDER" . strtoupper(substr(uniqid(), 0, 10));
        $wallet_transaction_amt = $fetch_wallet;


        $update_wallet = UPDATE_WALLET_PAYMENT($orderId, $wallet_amt, $userid);
        $add_wallet_transaction = ADD_WALLET_TRANSACTION($orderId, $wallet_transaction_amt, $userid);


        //add prder
        $update_payment_status = UPDATE_PAYMENT_STATUS($prod_order_id);
        $add_order = ADD_ORDER($orderId, $seller_id, $prod_name, $prod_order_id, $amt, $quantity, $address, $payemnt_option);
        $add_order_transaction = ADD_ORDER_TRANSACTION($orderId, $amt);

        if ($add_order_transaction == true) {
            echo "<script> 
                        location.href = '../thankyou.php';      
                    </script>";
        }
    } else {

       
        // $apiEndpoint = "https://test.cashfree.com";
        // $opUrl = $apiEndpoint . "/api/v1/order/create";

        // $cf_request = array();
        // $cf_request["appId"] = $appIdTest;
        // $cf_request["secretKey"] = $secretKeyTest;
        // $cf_request["orderId"] = "ORDER" . strtoupper(substr(uniqid(), 0, 10));
        // $cf_request["orderAmount"] = $amt;
        // $cf_request["orderNote"] = "Order Transaction";
        // $cf_request["customerPhone"] = $mob;
        // $cf_request["customerName"] = $name;
        // $cf_request["customerEmail"] = $mail;
        // $cf_request["returnUrl"] = "http://www/buzztro.com/Admin_modules/payment_booking.php?orderId=" . $cf_request["orderId"] . "&quantity=" . $quan . "&prodId=" . $prod_id . "&amt=" . $amt . "&product=" . $prod_name . "&product_order_id=" . $prod_order_id . "&wallet_amt=" . $wallet_amt . "&seller_id=" . $seller_id . "&address =". $address . "&mode = ". $payemnt_option;

        // $timeout = 10;

        // $request_string = "";
        // foreach ($cf_request as $key => $value) {
        //     $request_string .= $key . '=' . rawurlencode($value) . '&';
        // }

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "$opUrl?");
        // curl_setopt($ch, CURLOPT_POST, count($cf_request));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $request_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        // $curl_result = curl_exec($ch);
        // curl_close($ch);

        // $jsonResponse = json_decode($curl_result);
        // if ($jsonResponse->{'status'} == "OK") {
        //     $paymentLink = $jsonResponse->{"paymentLink"};
        //     header("Location: " . $paymentLink);
        // } else {
        //     echo "There was an error adding money." . $jsonResponse->{"reason"};;
        // }

        $api = new Api($keyId, $keySecret);


        $orderData = [
            'receipt'         => 3456,
            'amount'          => $amt * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpayOrderId = $razorpayOrder['id'];

        $_SESSION['razorpay_order_id'] = $razorpayOrderId;

        $displayAmount = $amount = $orderData['amount'];

        if ($displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
        }

        $data = [
            "key"               => $keyId,
            "amount"            => $amount,
            "name"              => $name,
            "description"       => "Add &#8377;" . $amt . " to wallet",
            "image"             => "",
            "prefill"           => [
                "name"              => $name,
                "email"             => $mail,
                "contact"           => $mob,
            ],
            "notes"             => [
                "address"           => "",
            ],
            "theme"             => [
                "color"             => "#39641d"
            ],
            "order_id"          => $razorpayOrderId,
            "quantity"          => $quantity,
            "prodId"            => $prod_id,
            "amount"            => $amt,
            "product"           => $prod_name,
            "wallet_amt"        => $wallet_amt,
            "seller_id"         => $seller_id,
            "address"           => $address,
            "mode"              => $pay,
            "product_order_id"  =>$prod_order_id
        ];

        if ($displayCurrency !== 'INR') {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }

        $json = json_encode($data);
    }

    //////////////////////////////////////////////////////////////////////////


}
?>
<body style="
            background-image: radial-gradient(#1CB5E0, #000046);">
    <div style="position: absolute;
            top: 50%;
            left: 50%;
            width: 30%;
            background: #ffffff;
            transform: translate(-50%,-50%);
            height: auto;
            padding: 20px 0;
            border-radius: 12px;
            font-family: 'Sarabun';
            box-shadow: 0 0 10px 2px rgba(0,0,0,0.5);
            text-align: center;">
        <h2>Buy Product</h2>
        <h3 style="margin: 30px 0;">Proceed to buy &#8377;<?php echo $amt; ?> worth of <?php echo $prod_name ?></h3 style="margin: 8px 0;">

        <!--  The entire list of Checkout fields is available at
                https://docs.razorpay.com/docs/checkout-form#checkout-fields -->
        <?php

        $transaction_id = "BKORDER" . strtoupper(substr(uniqid(), 0, 10));


        ?>
        <form action="./payment_booking.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="<?php echo $transaction_id; ?>" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
            </script>
            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
            <input type="hidden" name="trans_id" value="<?php echo $transaction_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $data['quantity'] ?>">
            <input type="hidden" name="prodId" value="<?php echo $data['prodId'] ?>">
            <input type="hidden" name="amount" value="<?php echo $data['amount'] ?>">
            <input type="hidden" name="product" value="<?php echo $data['product'] ?>">
            <input type="hidden" name="wallet_amt" value="<?php echo $data['wallet_amt'] ?>">
            <input type="hidden" name="seller_id" value="<?php echo $data['seller_id'] ?>">
            <input type="hidden" name="order_id" value="<?php echo $transaction_id ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="address" value="<?php echo $data['address'] ?>">
            <input type="hidden" name="mode" value="<?php echo $data['mode']; ?>">
            <input type="hidden" name="product_order_id" value="<?php echo $data['product_order_id']; ?>">
        </form>

    </div>
</body>