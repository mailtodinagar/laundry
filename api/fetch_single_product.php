
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new product($db);
 
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
			"product_id" => $row['product_id'],
			"product_name" => $row['product_name'],
			"product_image" => $row['product_image'],	
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
