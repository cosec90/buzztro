<?php

error_reporting(0);

function FETCH_STOCK_DATA($id){

    include '../Admin_config/connection.php';

    $query = "SELECT * FROM product_stock WHERE prod_id='$id'";
    
    $fetch_data = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($fetch_data);  
    return $data;
}

function UPDATE_STOCK_DATA($st,$sl,$id){
    include '../Admin_config/connection.php';

    $query = "UPDATE product_stock SET stock=$st, sold=$sl, last_updated='$date_time' where prod_id= '$id'";
    $update_query =  mysqli_query($conn,$query);
    return true;

}
function ADD_BOOKING_TRANSACTION_LOG($odrId,$usrId,$name,$id,$amt,$quan){

    include '../Admin_config/connection.php';

    $query = "INSERT INTO `booking_transactions`(`order_id`, `user_id`,`prod_name`,`prod_id`, `booking_amount`,`booking_quantity`, `date_time`) VALUES ('$odrId','$usrId','$name','$id','$amt','$quan', '$date_time')";
    $result = mysqli_query($conn,$query);
    return true;

}
function ADD_BOOKING($odrId,$usrId,$name,$id,$amt,$quan){

    include '../Admin_config/connection.php';
    $query = "INSERT INTO `bookings`(`order_id`, `user_id`,`prod_name`,`prod_id`, `bk_amt`,`bk_quantity`,`final_payment`, `date_time`) VALUES ('$odrId','$usrId','$name','$id','$amt','$quan','Unpaid', '$date_time')";
    $result = mysqli_query($conn,$query);

    //add alert
    return true;
}

function  UPDATE_PAYMENT_STATUS($id){

    include '../Admin_config/connection.php';

    $sql = "UPDATE `bookings` SET final_payment = 'Paid' WHERE order_id ='$id'";
    $result = mysqli_query($conn,$sql);

}

function FETCH_USER_BOOKING_TRANSACTIONS($userId)
{
    include './Admin_config/connection.php';
    $sql = "SELECT * FROM bookings WHERE user_id='$userId' and final_payment= 'Unpaid'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        while($row = mysqli_fetch_assoc($result))
        {
            $bookings[] = $row;
        }
    }

    return($bookings);
}

function FETCH_BOOKING_USING_ORDER($order_id){

    include './Admin_config/connection.php';
    $sql = "SELECT * FROM bookings WHERE order_id='$order_id'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        while($row = mysqli_fetch_assoc($result))
        {
            $bookings = $row;
        }
    }

    return($bookings);

}
function INSERT_WATCH_LIST($id,$usr_id,$username,$mob,$email){

    include '../Admin_config/connection.php';
    $query = "INSERT INTO `watch_list`(`prod_id`, `user_id`,`user_name`,`user_mob`, `user_mail`) VALUES ('$id','$usr_id','$username','$mob','$email')";
    $result = mysqli_query($conn,$query);
    if($result){

        echo '<script type="text/javascript">alert ("Successfully Added To Watch List");';
		echo 'window.location.href = "../index.php";';
		echo '</script>';
    }

}

function  INITIATE_REFUND($amt,$qty,$prod_id,$order_id,$prod_name){

    include '../Admin_config/connection.php';

    $sql = "UPDATE `bookings` SET final_payment = 'Refund' WHERE order_id ='$order_id'";
    $result = mysqli_query($conn,$sql);

    if($result){

        echo '<script type="text/javascript">alert ("Refund Initiated");';
        echo 'window.location.href = "../booking.php";';
        echo '</script>';
    }

}

?>