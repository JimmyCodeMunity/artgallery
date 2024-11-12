<?php
@include('../connection/connect.php');
include 'RegisterIPN.php';
$merchantreference = rand(1, 1000000000000000000);
$phone = $_POST['phone'];
$amount = $_POST['amount'];
$product_ids = json_decode($_POST['product_ids'], true);
$callbackurl = "https://8ce8-105-163-2-41.ngrok-free.app/artgallery/payment/response-page.php";
$branch = "Dev Jimin";
$first_name = "Alvin";
$middle_name = "Jimin";
$last_name = "Kiveu";
$email_address = "dev.jimin@gmail.com";

if (APP_ENVIROMENT == 'sandbox') {
    $submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";
} elseif (APP_ENVIROMENT == 'live') {
    $submitOrderUrl = "https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest";
} else {
    echo "Invalid APP_ENVIROMENT";
    exit;
}

$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);

// Request payload
$data = array(
    "id" => "$merchantreference",
    "currency" => "KES",
    "amount" => $amount,
    "description" => "Payment description goes here",
    "callback_url" => "$callbackurl",
    "notification_id" => "$ipn_id",
    "branch" => "$branch",
    "billing_address" => array(
        "email_address" => "$email_address",
        "phone_number" => "$phone",
        "country_code" => "KE",
        "first_name" => "$first_name",
        "middle_name" => "$middle_name",
        "last_name" => "$last_name",
        "line_1" => "Pesapal Limited",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "zip_code" => ""
    )
);

$ch = curl_init($submitOrderUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($responseCode == 200) {
    $responseData = json_decode($response, true);
    $order_tracking_id = $responseData['order_tracking_id'];

    // Database connection
    include 'connection/connect.php';

    // Update each order item with the order tracking ID
    if (is_array($product_ids)) {
        $stmt = $conn->prepare("UPDATE testorder SET tracking_id = ? WHERE id = ?");
        foreach ($product_ids as $product_id) {
            $stmt->bind_param("si", $order_tracking_id, $product_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    // Redirect to the payment page
    $redirect_url = $responseData['redirect_url'];
    header("Location: $redirect_url");
    exit();
} else {
    echo "Error: $responseCode";
    header('Location: index.php');
    exit();
}
