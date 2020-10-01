<?php
header("Access-Control-Allow-Origin: https://omid-soleimani.com");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: Content-Type');

$user_data = json_decode(file_get_contents('php://input'));


$username = htmlspecialchars($user_data->name);
$userEmail = htmlspecialchars($user_data->email);
$userMessage = htmlspecialchars($user_data->message);

$to = 'o.soleimani.ie@gmail.com';
$subject = "portfolio contact form";
$message = "<h3>sender name : {$username}</h3>";
$message .= "<h4>sender email : {$userEmail}</h4>";
$message .= "<p>{$userMessage}</p>";

$headers = "From: portfolio-website <omid@omid_soleimani.com>\r\n";
$headers .= "Reply-To: omid@omid_soleimani.com\r\n";
$headers .= "Content-type: text/html\r\n";

if($user_data) {
    try {
        mail($to, $subject, $message, $headers);
        http_response_code(200);
        echo json_encode(array("status" => "success"));
        
    } catch(Exception $err) {
        http_response_code(200);
        echo json_encode(array("status" => "unable to send message"));
    }
}