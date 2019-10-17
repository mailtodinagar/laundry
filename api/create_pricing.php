<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/pricing.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$product = new pricing($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));    

// set product property values
$product->product_id = $data->product_id;
$product->product_process = $data->product_process;
$product->product_cost = $data->product_cost;
 if($product->checkExists())
 {
	// set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Data Already Exists.")); 
 }
 else
 {
// use the create() method here
// create the user
if(
    !empty($product->product_id) &&
    !empty($product->product_process) &&
	!empty($product->product_cost) &&
    $product->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Price was created Successfully."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Price was created Failed."));
}
 }
?>