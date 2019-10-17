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
include_once 'objects/staff.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$staff = new staff($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$staff->id = $data->id;
$staff->staff_name = $data->staff_name;
$staff->staff_surname = $data->staff_surname;
$staff->staff_username = $data->staff_username;
$staff->staff_password = $data->staff_password;
$staff->staff_email = $data->staff_email;
$staff->staff_phone = $data->staff_phone;
$staff->staff_dob = $data->staff_dob;
$staff->staff_doj = $data->staff_doj;
$staff->staff_permission = $data->staff_permission;
$staff->staff_address = $data->staff_address;
$staff->status = $data->status;
 
// use the create() method here
// create the user
if(   
    !empty($staff->staff_name) &&
    !empty($staff->staff_username) &&
	!empty($staff->staff_password) &&
    !empty($staff->staff_email) &&
	!empty($staff->staff_phone) &&
    !empty($staff->staff_permission) &&
    $staff->update()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "staff was Updated Successfully."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to Update staff."));
}
?>