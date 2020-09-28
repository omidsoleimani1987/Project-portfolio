<?php
header("Access-Control-Allow-Origin: https://omid-soleimani.com");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");

$app_path = $_SERVER['DOCUMENT_ROOT'];

require $app_path . "/projects/davici/api/config/database.php";
require $app_path . "/projects/davici/api/objects/product.php";


// make connection to database
$database = new Database();
$db = $database->connect();

// initialize product object
$table_name = isset($_GET['tn']) ? $_GET['tn'] : null;
$product = new Product($db, $table_name);
$stmt = $product->read();

// check if any record found
$rowNum = $stmt->rowCount();
if($rowNum > 0) {
    $products_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        $row = array_map('utf8_encode', $row);
        array_push($products_arr, $row);
    }

    $result = json_encode($products_arr);
    http_response_code(200);
    echo $result;

} else {
    http_response_code(404);
    echo json_encode(array("message" => "No products found."));
}