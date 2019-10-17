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

// read the details of product to be edited
//$product->readOne();
$stmt = $product->getId();
$num = $stmt->rowCount();
if($num>0){
	 if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
    // create array
	$customer_id = substr($row['customer_id'], 2);
	$new_customer_id = "CU".($customer_id+1);
    $product_arr = array(		
			"customer_id" => $new_customer_id
        );
	 }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
	
	$new_customer_id = "CU1";
    $product_arr = array(		
			"customer_id" => $new_customer_id
        );
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
?>
