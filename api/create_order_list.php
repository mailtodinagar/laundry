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
include_once 'objects/orderlist.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$count=0;
// instantiate product object
$order = new orderlist($db);
 
// submitted data will be here
// get posted data
$array = json_decode(file_get_contents("php://input"),true);
foreach($array as $row)
{
// set product property values
$order->order_id = $row['order_id'];
$order->product_name = $row['product_name'];
$order->process_type = $row['process_type'];
$order->unit_cost = $row['unit_cost'];
$order->product_qty = $row['product_qty'];
$order->total = $row['total'];
 
// use the create() method here
// create the user
if(
    !empty($order->order_id) &&
    !empty($order->product_name) &&
    !empty($order->process_type) &&
	!empty($order->unit_cost) &&
    !empty($order->process_type) &&
	!empty($order->product_qty) &&
    !empty($order->total) &&
    $order->create()
){
 $count=1;
    
}
 
// message if unable to create user
else{
 $count=0;
   
}


}

if($count>0)
{
	// set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Order was created."));
}
else
{
	 // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create Order."));
}
?>