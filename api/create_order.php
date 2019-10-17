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
include_once 'objects/order.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$order = new order($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$order->order_id = $data->order_id;
$order->customer_id = $data->customer_id;
$order->customer_name = $data->customer_name;
$order->customer_contact = $data->customer_contact;
$order->process_type = $data->process_type;
$order->tax_percentage = $data->tax_percentage;
$order->tax_amount = $data->tax_amount;
$order->discount_percentage = $data->discount_percentage;
$order->discount_amount = $data->discount_amount;
$order->total_qty = $data->total_qty;
$order->net_amount = $data->net_amount;
$order->payable_amount = $data->payable_amount;
 
// use the create() method here
// create the user
if(
    !empty($order->order_id) &&
    !empty($order->customer_id) &&
    !empty($order->customer_name) &&
	!empty($order->customer_contact) &&
    !empty($order->process_type) &&
	!empty($order->tax_percentage) &&
    !empty($order->tax_amount) &&
	!empty($order->discount_percentage) &&
    !empty($order->discount_amount) &&
	!empty($order->total_qty) &&
	!empty($order->net_amount) &&
    !empty($order->payable_amount) &&
    $order->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Order was created."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create Order."));
}
?>