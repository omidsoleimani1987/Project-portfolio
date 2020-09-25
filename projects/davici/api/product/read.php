<?php
header("Access-Control-Allow-Origin: http://localhost/projects/davici/index.html");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers', 'Content-Type');

include_once '../config/database.php';
include_once '../objects/product.php';

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
    $products_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($products_arr, $row);
    }
  
    http_response_code(200);
    echo json_encode($products_arr);


} else {
    http_response_code(404);
    echo json_encode(array("message" => "No products found."));
}