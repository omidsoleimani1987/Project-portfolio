<?php
header("Access-Control-Allow-Origin: http://localhost/projects/davici/index.html");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers', 'Content-Type');

// check the session status and check id user logged in
if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
    http_response_code(200);
    echo json_encode(array("status" => "you should logout first!"));
    exit;
}

include_once '../config/database.php';
include_once '../objects/user.php';

// make connection to database
$database = new Database();
$db = $database->connect();

// initialize login object
$user_data = json_decode(file_get_contents('php://input'));

$firstname = htmlspecialchars($user_data->firstname);
$lastname = htmlspecialchars($user_data->lastname);
$email = htmlspecialchars($user_data->email);
$username = htmlspecialchars($user_data->username);
$password = htmlspecialchars($user_data->password);

$signup = new User($db);
$stmt = $signup->read();

$new_username = true;

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    for($i=0; $i<count($result); $i++) {
        if($result[$i]['username'] == trim($username)) {
            http_response_code(200);
            echo json_encode(array("status" => "this username is taken already"));
            $new_username = false;
            break;
        } 
    }
}

if($new_username) {
    try {
        $signup->register($firstname, $lastname, $email, $username, $password);
        http_response_code(200);
        echo json_encode(array("status" => "success"));
    } catch(Exception $err) {
        http_response_code(200);
        echo json_encode(array("status" => "unable to sign up"));
    }
}