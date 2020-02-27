<?php
ob_start();
session_start();
include('dbconnect.php');
$sql="SELECT * FROM cart WHERE userID =".$_SESSION['user'];
$query= mysqli_query($conn,$sql);
$i = 1;
class Paypal {
   /**
    * Last error message(s)
    * @var array
    */
   protected $_errors = array();

   /**
    * API Credentials
    * Use the correct credentials for the environment in use (Live / Sandbox)
    * @var array
    */
   protected $_credentials = array(
      'USER' => '',
      'PWD' => '',
      //'SIGNATURE' =>'',
   );

   /**
    * API endpoint
    * Live - https://api-3t.paypal.com/nvp
    * Sandbox - https://api-3t.sandbox.paypal.com/nvp
    * @var string
    */
   protected $_endPoint = 'https://api-3t.paypal.com/nvp';

   /**
    * API Version
    * @var string
    */
   protected $_version = '74.0';

   /**
    * Make API request
    *
    * @param string $method string API method to request
    * @param array $params Additional request parameters
    * @return array / boolean Response array / boolean false on failure
    */
   public function request($method,$params = array()) {
      $this -> _errors = array();
      if( empty($method) ) { //Check if API method is not empty
         $this -> _errors = array('API method is missing');
         return false;
      }

      //Our request parameters
      $requestParams = array(
         'METHOD' => $method,
         'VERSION' => $this -> _version
      ) + $this -> _credentials;

      //Building our NVP string
      $request = http_build_query($requestParams + $params);

      //cURL settings
      $curlOptions = array (
         CURLOPT_URL => $this -> _endPoint,
         CURLOPT_VERBOSE => 1,
         CURLOPT_SSL_VERIFYPEER => true,
         CURLOPT_SSL_VERIFYHOST => 2,
         CURLOPT_CAINFO => dirname(__FILE__) . '/cacert.pem', //CA cert file
         CURLOPT_RETURNTRANSFER => 1,
         CURLOPT_POST => 1,
         CURLOPT_POSTFIELDS => $request
      );

      $ch = curl_init();
      curl_setopt_array($ch,$curlOptions);

      //Sending our request - $response will hold the API response
      $response = curl_exec($ch);

      //Checking for cURL errors
      if (curl_errno($ch)) {
         $this -> _errors = curl_error($ch);
         curl_close($ch);
         return false;
         //Handle errors
      } else  {
         curl_close($ch);
         $responseArray = array();
         parse_str($response,$responseArray); // Break the NVP string to an array
         return $responseArray;
      }
   }
}


//Our request parameters
$requestParams = array(
   'RETURNURL' => 'http://sellcards.steve-kirby.website/index.php',
   'CANCELURL' => 'http://sellcards.steve-kirby.website/index.php'
);


while ($row = mysqli_fetch_array($query)){
	
	$query2 = mysqli_query($conn,"SELECT * FROM card WHERE cardID={$row['cardID']}");
	while($row2 = mysqli_fetch_array($query2)){
		${'tug'.$i} = $row2['cardName'];
		$i+=1;
		${'tug'.$i} = $row2['cardDescription'];
		$i+=1;
		${'tug'.$i} = $row2['cardPrice'];
		$i+=1;
		$total += $row2['cardPrice'];
		${'tug'.$i} = 1;
		$i+=1;
	}
}

$item = array(
   'L_PAYMENTREQUEST_0_NAME0' => $tug1,
   'L_PAYMENTREQUEST_0_DESC0' => $tug2,
   'L_PAYMENTREQUEST_0_AMT0' => $tug3,
   'L_PAYMENTREQUEST_0_QTY0' => $tug4,
   'L_PAYMENTREQUEST_0_NAME1' => $tug5,
   'L_PAYMENTREQUEST_0_DESC1' => $tug6,
   'L_PAYMENTREQUEST_0_AMT1' => $tug7,
   'L_PAYMENTREQUEST_0_QTY1' => $tug8,
   'L_PAYMENTREQUEST_0_NAME2' => $tug9,
   'L_PAYMENTREQUEST_0_DESC2' => $tug10,
   'L_PAYMENTREQUEST_0_AMT2' => $tug11,
   'L_PAYMENTREQUEST_0_QTY2' => $tug12,
   'L_PAYMENTREQUEST_0_NAME3' => $tug13,
   'L_PAYMENTREQUEST_0_DESC3' => $tug14,
   'L_PAYMENTREQUEST_0_AMT3' => $tug15,
   'L_PAYMENTREQUEST_0_QTY3' => $tug16,
   'L_PAYMENTREQUEST_0_NAME4' => $tug17,
   'L_PAYMENTREQUEST_0_DESC4' => $tug18,
   'L_PAYMENTREQUEST_0_AMT4' => $tug19,
   'L_PAYMENTREQUEST_0_QTY4' => $tug20

    
);
$orderParams = array(
   'PAYMENTREQUEST_0_AMT' => $total + 4,
   'PAYMENTREQUEST_0_SHIPPINGAMT' => '4',
   'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP',
   'PAYMENTREQUEST_0_ITEMAMT' => $total
);

$paypal = new Paypal();
$response = $paypal -> request('SetExpressCheckout',$requestParams + $orderParams + $item);

if(is_array($response) && $response['ACK'] == 'Success') { //Request successful
      $token = $response['TOKEN'];
      header( 'Location: https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) );
}
?>