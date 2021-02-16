<?php

session_start();

function ADD_ORDER_TRANSACTION($id,$amt){

    
    include '../Admin_config/connection.php';

    $userId = $_SESSION['user_id'];
    $sql ="INSERT INTO `order_transaction` (`order_id`,`user_id`,`order_amt`,`date_time`) VALUES ('$id','$userId','$amt','$date_time')";
    $result = mysqli_query($conn,$sql);

    return true;

}
function ADD_ORDER($ordrId,$seller,$name,$pd_id,$prod_amt,$quan,$addr,$mod){

    include '../Admin_config/connection.php';
    $userId = $_SESSION['user_id'];
    $sql ="INSERT INTO `orders` (`order_id`,`seller_id`,`user_id`,`prod_name`,`prod_id`,`order_amt`,`order_quantity`, `delivery_address`, `payment_status`, `date_time`) VALUES ('$ordrId','$seller','$userId','$name','$pd_id','$prod_amt','$quan','$addr','$mod','$date_time')";
    $result = mysqli_query($conn,$sql);
    return true;
}

function FETCH_USER_ORDER($id){

    include './Admin_config/connection.php';

    $sql = "SELECT * FROM orders WHERE user_id = '$id'";
    $result= mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    if ($count > 0) {
        while($row = mysqli_fetch_assoc($result))
        {
            $orders[] = $row;
        }
    }
    return($orders);
}


?>