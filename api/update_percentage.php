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
include_once 'objects/percentage.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$percentage = new percentage($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// set product property values
$percentage->id = $data->id;
$percentage->process_type = $data->process_type;
$percentage->inc_percentage = $data->inc_percentage;
$percentage->small_desc = $data->small_desc;
$percentage->status = $data->status;
 
// use the create() method here
// create the user
if(   
    !empty($percentage->process_type) &&
    !empty($percentage->inc_percentage) &&
	!empty($percentage->status) &&
    $percentage->update()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "percentage was Updated Successfully."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to Update percentage."));
}
?>