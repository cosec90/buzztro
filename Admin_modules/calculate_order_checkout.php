<?php
include '../Admin_controllers/products.php';
include '../Admin_config/connection.php';

$prod_id = $_POST['id'];
$quan = $_POST['quan'];


$sql = "SELECT `product_info`.`prod_id`, `product_info`.`seller_Id`, `product_info`.`prod_name`,`product_info`.`prod_desc`, `product_info`.`prod_stock` AS `total_stock`, `product_info`.`prod_timer`, `product_info`.`file1`,`product_info`.`file2`, `product_info`.`file3`, `product_info`.`file4`, `product_info`.`file5`, `product_info`.`booking_amt`, `product_info`.`prod_category`,`product_info`.`prod_tags`, `product_stock`.`stock` AS `stock`, `product_stock`.`sold` AS `sold`,`stock_rate_relation`.`admin_rate` FROM `product_info` LEFT JOIN `product_stock` ON `product_info`.`prod_id`=`product_stock`.`prod_id` LEFT JOIN `stock_rate_relation` ON `product_info`.`prod_id` = `stock_rate_relation`.`prod_id` WHERE `product_info`.`prod_status` = 'Approved' AND `product_info`.`prod_id`='$prod_id' AND `stock_rate_relation`.`prod_stock` <=  `product_stock`.`sold` ORDER BY `stock_rate_relation`.`admin_rate` ASC LIMIT 1";


$result = mysqli_query($conn, $sql);

$stock_rate_res = mysqli_query($conn, "SELECT `admin_rate`,`prod_stock` FROM `stock_rate_relation` WHERE `prod_id` = '$prod_id'");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $featured_prod = $row;
    }

    while ($stock_row = mysqli_fetch_assoc($stock_rate_res)) {
        $featured_prod['price'][] = $stock_row['admin_rate'];
        $featured_prod['stock_div'][] = $stock_row['prod_stock'];
    }
}
// print_r($featured_prod['stock_div']);

$price_arr = $featured_prod['price'];
$div_arr = $featured_prod['stock_div'];
$stocks_sold = $featured_prod['sold'];
$stocks_left = $featured_prod['stock'];
$final_price = 0;



if ($quan > $stocks_left) {

    echo "excceed";
} else {


    $final_amount = FUNCTION_OP($price_arr, $div_arr, $quan, $stocks_sold, $final_price);
    echo $final_amount;
}
function FUNCTION_OP($stock_price_arr, $stock_div_arr, $quantity, $sold, $final_stock_price)
{


    if ($quantity > 0) {


        if ($stock_div_arr[0] <= $sold && $sold < $stock_div_arr[1]) {

            $starting_price = $stock_price_arr[0];
            $remaining_stock = $stock_div_arr[1] - $sold;

            if ($quantity > $remaining_stock) {



                $quantity = $quantity - $remaining_stock;

                $sold = $sold + $remaining_stock;

                $price = $remaining_stock * $starting_price;
                $final_stock_price = $final_stock_price + $price;
            } else {

                $sold = $sold + $quantity;
                $new_quan = $quantity;
                $price = $new_quan * $starting_price;
                $final_stock_price = $final_stock_price + $price;
                $quantity = 0;
            }
        } elseif ($stock_div_arr[1] <= $sold && $sold < $stock_div_arr[2]) {

            $starting_price = $stock_price_arr[1];
            $remaining_stock = $stock_div_arr[2] - $sold;

            if ($quantity > $remaining_stock) {



                $quantity = $quantity - $remaining_stock;

                $sold = $sold + $remaining_stock;
                $price = $remaining_stock * $starting_price;
                $final_stock_price = $final_stock_price + $price;
            } else {

                $sold = $sold + $quantity;
                $new_quan = $quantity;
                $price = $new_quan * $starting_price;
                $final_stock_price = $final_stock_price + $price;
                $quantity = 0;
            }
        } elseif ($stock_div_arr[2] <= $sold && $sold < $stock_div_arr[3]) {

            $starting_price = $stock_price_arr[2];
            $remaining_stock = $stock_div_arr[3] - $sold;

            if ($quantity > $remaining_stock) {


                $quantity = $quantity - $remaining_stock;

                $sold = $sold + $remaining_stock;
                $price = $remaining_stock * $starting_price;
                $final_stock_price = $final_stock_price + $price;
            } else {

                $sold = $sold + $quantity;
                $new_quan = $quantity;
                $price = $new_quan * $starting_price;
                $final_stock_price = $final_stock_price + $price;
                $quantity = 0;
            }
        } elseif ($stock_div_arr[3] <= $sold && $sold < $stock_div_arr[4]) {

            $starting_price = $stock_price_arr[3];
            $remaining_stock = $stock_div_arr[4] - $sold;

            if ($quantity > $remaining_stock) {


                $quantity = $quantity - $remaining_stock;

                $sold = $sold + $remaining_stock;
                $price = $remaining_stock * $starting_price;
                $final_stock_price = $final_stock_price + $price;
            } else {

                $sold = $sold + $quantity;
                $new_quan = $quantity;
                $price = $new_quan * $starting_price;
                $final_stock_price = $final_stock_price + $price;
                $quantity = 0;
            }
        } else {

            $starting_price = $stock_price_arr[4];
            $remaining_stock = $stock_div_arr[4] + 1 - $sold;

            if ($quantity >= $remaining_stock) {
                $quantity = $quantity - $remaining_stock;

                $sold = $sold + $remaining_stock;
                $price = $remaining_stock * $starting_price;
                $final_stock_price = $final_stock_price + $price;
            } else {
                $sold = $sold + $quantity;
                $new_quan = $quantity;
                $price = $new_quan * $starting_price;
                $final_stock_price = $final_stock_price + $price;
                $quantity = 0;
            }
        }

        // echo "<br>";
        // echo "<br>";
        // echo "Starting price" . $starting_price;
        // echo "<br>";
        // echo "remainf stock" . $remaining_stock;
        // echo "<br>";
        // echo "quantity" . $quantity;
        // echo "<br>";
        // echo "Updated sold" . $sold;
        // echo "<br>";
        // echo "<br>";
        // echo "Final price" . $final_stock_price;

        return FUNCTION_OP($stock_price_arr, $stock_div_arr, $quantity, $sold, $final_stock_price);
    } else {
        return $final_stock_price;
    }
}
