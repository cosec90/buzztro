<?php
include 'header.php';
include 'Admin_config/connection.php';

session_start();

?>

<body>
	<?php include 'nav.php';
	// print_r($prod_info);


	?>
	<!-- checkout page -->
	<div class="thank-outer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="left-thank">
                        <div class="thank-img-cont">
                            <img class="thank-img" src="images/thank_you.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="right-thank">
                        <div class="thank-content">
                            <h1 class="text-center">Thank You For Shopping!</h1>
                           <a href="index.php"> <button class="btn" type="button">Go To Home</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
	<!-- //checkout page -->
	<?php include 'footer.php'; ?>