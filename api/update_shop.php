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
include_once 'objects/shop.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$shop = new shop($db);
 
// submitted data will be here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$shop->id = $data->id;
$shop->shop_name = $data->shop_name;
$shop->shop_country = $data->shop_country;
$shop->tax_no = $data->tax_no;
$shop->tax_percentage = $data->tax_percentage;
$shop->shop_address = $data->shop_address;
$shop->shop_desc = $data->shop_desc;
 
// use the create() method here
// create the user
if(   
    !empty($shop->shop_country) &&
    !empty($shop->tax_no) &&
	!empty($shop->tax_percentage) &&
    !empty($shop->shop_address) &&
	!empty($shop->shop_desc) &&
    !empty($shop->shop_name) &&
    $shop->update()
){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Shop was Updated Successfully."));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: unable to create user
    echo json_encode(array("message" => "Unable to Update Shop."));
}
?>