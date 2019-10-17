<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/orderlist.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new orderlist($db);
 
// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
//$product->readOne();
$stmt = $product->readOne();
$num = $stmt->rowCount();
if($num>0){
    // products array
    $products_arr=array();
    //$products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $product_item=array(
             "id" => $row['id'],
			"order_id" => $row['order_id'],
			"product_name" => $row['product_name'],
			"process_type" => $row['process_type'],			
            "unit_cost" => $row['unit_cost'],
			"product_qty" => $row['product_qty'],	
			"total" => $row['total'],			
			"status"=> $row['status'],
			"createdat"=> $row['createdat'],
			"updatedat"=> $row['updatedat']
        );
 
        array_push($products_arr, $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($products_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Order does not exist."));
}
?>
