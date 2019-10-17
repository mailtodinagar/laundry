<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/order.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new order($db);
 
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
			"order_id" => $row['order_id'],
			"customer_id" => $row['customer_id'],
			"customer_name" => $row['customer_name'],
			"customer_contact" => $row['customer_contact'],			
            "process_type" => $row['process_type'],
			"tax_percentage" => $row['tax_percentage'],			
            "tax_amount" => $row['tax_amount'],
			"discount_percentage" => $row['discount_percentage'],			
            "discount_amount" => $row['discount_amount'],
			"total_qty" => $row['total_qty'],			
            "net_amount" => $row['net_amount'],
			"payable_amount" => $row['payable_amount'],
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
    echo json_encode(array("message" => "Order does not exist."));
}
?>
