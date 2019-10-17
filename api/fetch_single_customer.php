<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new customer($db);
 
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
			"customer_id" => $row['customer_id'],
			"cus_first_name" => $row['cus_first_name'],
			"cus_last_name" => $row['cus_last_name'],			
            "cus_email" => $row['cus_email'],
			"cus_contact" => $row['cus_contact'],			
            "cus_type" => $row['cus_type'],
			"cus_gender" => $row['cus_gender'],			
            "cus_address" => $row['cus_address'],
			"cus_img" => $row['cus_img'],			
            "wallet_amt" => $row['wallet_amt'],
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
    echo json_encode(array("message" => "Product does not exist."));
}
?>
