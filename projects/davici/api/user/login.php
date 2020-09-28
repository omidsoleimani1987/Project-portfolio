<?php
header("Access-Control-Allow-Origin: https://omid-soleimani.com");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");

// check the session status and check id user logged in
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
    http_response_code(200);
    echo json_encode(array("status" => "user is already logged in!"));
    exit;
}

$app_path = $_SERVER['DOCUMENT_ROOT'];

require $app_path . "/projects/davici/api/config/database.php";
require $app_path . "/projects/davici/api/objects/user.php";

// make connection to database
$database = new Database();
$db = $database->connect();

// initialize login object
$user_data = json_decode(file_get_contents('php://input'));
$username = htmlspecialchars($user_data->username);
$password = htmlspecialchars($user_data->password);

$login = new User($db);
$stmt = $login->read();

$search_result = false;
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($result['username'] == $username && $result['password'] == $password) {
        $search_result = true;
        $_SESSION['login'] = true;
        break;
    }
}

if($search_result) {
    http_response_code(200);
    echo json_encode(array("status" => "success", "username" => $username));
} else {
    http_response_code(200);
    echo json_encode(array("status" => "unable to login"));
}