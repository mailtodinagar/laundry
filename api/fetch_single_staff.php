<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/staff.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new staff($db);
 
// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
//$product->readOne();
$stmt = $product->readOne();
$num = $stmt->rowCount();
if($num>0){
	 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
    // create array
    $product_arr = array(
			"id" => $row['id'],
			"staff_id" => $row['staff_id'],
			"staff_name" => $row['staff_name'],
			"staff_surname" => $row['staff_surname'],			
            "staff_username" => $row['staff_username'],
			"staff_password" => $row['staff_password'],			
            "staff_email" => $row['staff_email'],
			"staff_phone" => $row['staff_phone'],			
            "staff_dob" => $row['staff_dob'],
			"staff_doj" => $row['staff_doj'],
			"staff_img" => $row['staff_img'],			
            "staff_permission" => $row['staff_permission'],
			"staff_address" => $row['staff_address'],
			"status"=> $row['status'],
			"createdat"=> $row['createdat'],
			"updatedat"=> $row['updatedat']
        );
	 }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Staff does not exist."));
}
?>
