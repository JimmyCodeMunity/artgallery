<?php
//https://12eb-41-81-142-80.ngrok-free.app/pesapal/callback.php
//?OrderTrackingId=1c298d87-ef37-4e7c-ab33-de3dfccce94d
//&OrderMerchantReference=92582762768768274
include 'acesstoken.php';
include '../connection/connect.php';
include '../tailwindcss.php';
$OrderTrackingId = $_GET['OrderTrackingId'];
$OrderMerchantReference = $_GET['OrderMerchantReference'];
if(APP_ENVIROMENT == 'sandbox'){
  $getTransactionStatusUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
}elseif(APP_ENVIROMENT == 'live'){
  $getTransactionStatusUrl = "https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
}else{
  echo "Invalid APP_ENVIROMENT";
  exit;
}
$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);
$ch = curl_init($getTransactionStatusUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if($responseCode == 200){
  // echo "success response code after transaction".$responseCode;
  $update = "UPDATE testorder SET bought = 1 WHERE tracking_id = '$OrderTrackingId'";
  $result = mysqli_query($conn, $update);

  if($result){
    // echo "Transaction Successful";
    header('location:../successpay.php');
  }
  else{
    echo "Failed to update transaction status in the database";
  }

}

curl_close($ch);
?>





