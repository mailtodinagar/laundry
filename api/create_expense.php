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
include_once 'objects/expenses.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$expenses = new expenses($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$expenses->entry_date = $data->entry_date;
$expenses->exp_amount = $data->exp_amount;
$expenses->exp_reason = $data->exp_reason;
$expenses->exp_desc = $data->exp_desc;
 
// use the create() method here
// create the user
if(
    !empty($expenses->entry_date) &&
    !empty($expenses->exp_amount) &&
    !empty($expenses->exp_reason) &&
	!empty($expenses->exp_desc) &&
    $expenses->create()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Expense was created Successfully."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Expense was created Failed."));
}
?>