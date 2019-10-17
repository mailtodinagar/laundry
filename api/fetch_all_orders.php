<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json'); 
// database connection will be here
// include database and object files
include_once 'config/database.php';
include_once 'objects/order.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new order($db);
 
// read products will be here
// query products
$stmt = $product->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
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
 
        array_push($products_arr, $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
}
 
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No Data found.")
    );
}
?>