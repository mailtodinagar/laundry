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
include_once 'objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$customer = new customer($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$customer->customer_id = $data->customer_id;
$customer->cus_first_name = $data->cus_first_name;
$customer->cus_last_name = $data->cus_last_name;
$customer->cus_email = $data->cus_email;
$customer->cus_contact = $data->cus_contact;
$customer->cus_type = $data->cus_type;
$customer->cus_gender = $data->cus_gender;
$customer->cus_address = $data->cus_address;
$customer->wallet_amt = $data->wallet_amt;
 
// use the create() method here
// create the user
if($customer->checkExists())
{
	  // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "User Already Exists."));
}
else
{
if(
    !empty($customer->customer_id) &&
    !empty($customer->cus_first_name) &&
    !empty($customer->cus_last_name) &&
	!empty($customer->cus_email) &&
    !empty($customer->cus_contact) &&
	!empty($customer->cus_type) &&
    !empty($customer->cus_gender) &&
	!empty($customer->cus_address) &&
    !empty($customer->wallet_amt) &&
    $customer->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "User was created."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to create user."));
}
}
?>