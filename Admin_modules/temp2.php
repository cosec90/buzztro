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
                $remaining_stock = $stock_div_arr[4]+1 - $sold;

                if($quantity >= $remaining_stock){
                    $quantity = $quantity - $remaining_stock;

                    $sold = $sold + $remaining_stock;
                    $price = $remaining_stock * $starting_price;
                    $final_stock_price = $final_stock_price + $price;
                }
                else{
                    $sold = $sold + $quantity;
                    $new_quan = $quantity;
                    $price = $new_quan * $starting_price;
                    $final_stock_price = $final_stock_price + $price;
                    $quantity = 0;
                }

                
            }

            echo "<br>";
            echo "<br>";
            echo "Starting price" . $starting_price;
            echo "<br>";
            echo "remainf stock" . $remaining_stock;
            echo "<br>";
            echo "quantity" . $quantity;
            echo "<br>";
            echo "Updated sold" . $sold;
            echo "<br>";
            echo "<br>";
            echo "Final price" . $final_stock_price;

            return FUNCTION_OP($stock_price_arr, $stock_div_arr, $quantity, $sold, $final_stock_price);
        } else {
            return $final_stock_price;
        }
    }
    $final_amount = FUNCTION_OP($price_arr,$div_arr,$quan, $stocks_sold,$final_price);




    <!-- <form action="./Admin_modules/confirm_booking.php" method="POST">
													<input type="hidden" name="amount" value="<?php echo $value['bk_amt'] ?>">
													<input type="hidden" name="quantity" value="<?php echo $value['bk_quantity'] ?>">
													<input type="hidden" name="prod_id" value="<?php echo $value['prod_id'] ?>" id="prod_id">
													<input type="hidden" name="order_id" value="<?php echo $value['order_id']; ?>">
													<input type="hidden" name="prod_name" value="<?php echo $prod_info['prod_name'] ?>">
													<input type="hidden" value="<?php echo $prod_info['sold']; ?>" name="stocks_sold">
													<input type="hidden" value="<?php echo $prod_info['stock']; ?>" name="stock">

													<?php foreach ($prod_info['price'] as $value) {  ?>

<input type="hidden" value="<?php echo $value; ?>" name="price_arr[]">

<?php } ?>

<?php foreach ($prod_info['stock_div'] as $value) {  ?>

<input type="hidden" value="<?php echo $value; ?>" name="stock_arr[]">
</form> -->

<?php } ?>