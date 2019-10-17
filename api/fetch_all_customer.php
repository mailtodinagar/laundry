<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json'); 
// database connection will be here
// include database and object files
include_once 'config/database.php';
include_once 'objects/customer.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new customer($db);
 
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
        array("message" => "No products found.")
    );
}
?>