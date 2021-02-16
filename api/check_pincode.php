<?php
require '../Admin_config/api_config.php';


//vamaship
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://ecom3stagingapi.vamaship.com/ecom/api/v1/dom/quote");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"seller\": {
    \"address\": \"abc, xyz ajshd jashd jsha\",
    \"city\": \"Mumbai\",
    \"country\": \"India\",
    \"email\": \"seller@bizstreet.com\",
    \"name\": \"Rahul Ghose\",
    \"phone\": \"99999999999\",
    \"pincode\": \"400005\",
    \"state\": \"Maharashtra\"
  },
  \"shipments\": [
    {
      \"gst_tin\": \"\",
      \"hsn_code\": \"63071030\",
      \"address\": \"$add1\",
      \"breadth\": \"10\",
      \"city\": \"Jaipur\",
      \"country\": \"India\",
      \"email\": \"$mail\",
      \"height\": \"10\",
      \"is_cod\": false,
      \"length\": \"10\",
      \"name\": \"$name\",
      \"phone\": \"$mobile\",
      \"pickup_date\": \"2015-12-20T14:15:16+05:30\",
      \"pincode\": \"$pincode\",
      \"product\": \"Diary\",
      \"product_value\": 100,
      \"quantity\": 1,
      \"reference1\": \"002\",
      \"reference2\": \"refno2\",
      \"state\": \"$state\",
      \"unit\": \"cm\",
      \"weight\": \"0.6\",
      \"cargo_type\": \"general\",
      \"liability\": \"no\"
    }
  ]
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "Authorization: Bearer ".$log_access_token
));

$response = curl_exec($ch);
curl_close($ch);
$jsonDecode = json_decode($response);
$array_quotes =  $jsonDecode->{'quotes'};

// print_r($array_quotes);
if(gettype($array_quotes) == "array"){

    // echo $array_quotes[0]->{'success'}; 
    if($array_quotes[0]->{'success'} == true){
      return $message="true";
      // echo "success";
    }
    else{
      return $message = "false";
      
    }

  }
else{
  // print_r( $array_quotes->{'success'});
  return $message = "false";
  // echo "false";
  // print_r($jsonDecode);
}


?>