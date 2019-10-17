<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
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
$stmt = $product->fetch_all();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){ 
 
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
				/*$data['id'] = $row['id'];
				$data['customer_id'] = $row['customer_id'];
				$data['cus_first_name'] = $row['cus_first_name'];
				$data['cus_last_name'] = $row['cus_last_name'];
				$data['cus_email'] = $row['cus_email'];*/
			}

 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($data);
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