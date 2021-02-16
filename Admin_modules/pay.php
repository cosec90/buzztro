<?php
require('../Admin_config/api_config.php');
require('../razorpay-php/Razorpay.php');
session_start();
// Create the Razorpay Order
use Razorpay\Api\Api;

if (isset($_POST['submit'])) 
{
    $userid = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
    $mail = $_SESSION['user_mail'];
    $mob = $_SESSION['user_mob'];
    $amt = $_POST['amt'];
}

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

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

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $name,
    "description"       => "Add &#8377;".$amt." to wallet",
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
    "order_id"          => $razorpayOrderId
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);?>

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
    text-align: center;"
    >
        <h2>Add money to wallet</h2>
        <h3 style="margin: 30px 0;">Proceed to add &#8377;<?php echo $amt;?> to your Buzztro wallet</h3 style="margin: 8px 0;">
        
        <!--  The entire list of Checkout fields is available at
		 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->
		<?php 

		$transaction_id = "WALLET".strtoupper(substr(uniqid(),0,10));

		?>
		<form action="./check_wallet_status.php" method="POST">
		  <script
		    src="https://checkout.razorpay.com/v1/checkout.js"
		    data-key="<?php echo $data['key']?>"
		    data-amount="<?php echo $data['amount']?>"
		    data-currency="INR"
		    data-name="<?php echo $data['name']?>"
		    data-image="<?php echo $data['image']?>"
		    data-description="<?php echo $data['description']?>"
		    data-prefill.name="<?php echo $data['prefill']['name']?>"
		    data-prefill.email="<?php echo $data['prefill']['email']?>"
		    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
		    data-notes.shopping_order_id="<?php echo $transaction_id;?>"
		    data-order_id="<?php echo $data['order_id']?>"
		    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
		    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
		  >
		  </script>
		  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
		  <input type="hidden" name="trans_id" value="<?php echo $transaction_id;?>">
		  <input type="hidden" name="amount" value="<?php echo $data['amount']?>">
		  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
		</form>


    </div>
</body>
