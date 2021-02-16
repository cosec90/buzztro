<?php 

$featured_products = FEATURED_PRODUCTS();
$categorized_cards = FETCH_CARDS();
//pre_r($featured_products);

function pre_r($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
?>