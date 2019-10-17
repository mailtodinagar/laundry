<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json'); 
// database connection will be here
// include database and object files
include_once 'config/database.php';
include_once 'objects/shop.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$shop = new shop($db);
 
// read products will be here
// query products
$stmt = $shop->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    //$products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only 
        extract($row);
        $product_item=array(
             "id" => $row['id'],
			"shop_name" => $row['shop_name'],
			"shop_country" => $row['shop_country'],
			"tax_no" => $row['tax_no'],			
            "tax_percentage" => $row['tax_percentage'],
			"shop_address" => $row['shop_address'],			
            "shop_desc" => $row['shop_desc'],
			"shop_logo" => $row['shop_logo'],			
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