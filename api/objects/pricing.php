<?php
// 'user' object
class pricing{
 
    // database connection and table name
    private $conn;
    private $table_name = "price_config";

    // object properties
    public $id;
    public $product_id;   
    public $product_process;
    public $product_cost;	
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create() method will be here
// create new user record
function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                product_id = :product_id,                
                product_process = :product_process,
				product_cost = :product_cost";				
 
    // prepare the query
	/*$image = base64_decode($this->input->post("product_image"));
	$image_name = md5(uniqid(rand(), true));
	$filename = $image_name . '.' . 'png';
	//rename file name with random number
	$path = "images/".$filename;
	//image uploading folder path
	file_put_contents($path . $filename, $image);
	// image is bind and upload to respective folder*/
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->product_id=htmlspecialchars(strip_tags($this->product_id));   
    $this->product_process=htmlspecialchars(strip_tags($this->product_process));
    $this->product_cost=htmlspecialchars(strip_tags($this->product_cost));	
	
	
    // bind the values
    $stmt->bindParam(':product_id', $this->product_id);   
    $stmt->bindParam(':product_process', $this->product_process);
	$stmt->bindParam(':product_cost', $this->product_cost);	
   
 
    // hash the password before saving to database
    //$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    //$stmt->bindParam(':password', $password_hash);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
 
// emailExists() method will be here
// check if given email exist in the database
function checkExists(){
 
    // query to check if email exists
	   $query = "SELECT *  FROM
                " . $this->table_name . " WHERE product_id = ? 
				AND 
				 product_process = ? 
            LIMIT
                0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
	$this->product_id=htmlspecialchars(strip_tags($this->product_id));
    $this->product_process=htmlspecialchars(strip_tags($this->product_process));
 
    // bind given email value
    $stmt->bindParam(1, $this->product_id);
	 $stmt->bindParam(2, $this->product_process);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

 // read all pricing
function read(){

 
    // select all query
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY createdat";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// used get single pricing by productid and process
function readOne(){
 
    // query to read single record
    $query = "SELECT *  FROM
                " . $this->table_name . " WHERE product_id = ? 
				AND 
				 product_process = ? 
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
	$stmt->bindParam(2, $this->process);
 
    // execute query
    $stmt->execute();
	return $stmt;
    // get retrieved row
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    //$this->cus_first_name = $row['cus_first_name'];
    //$this->cus_email = $row['cus_email'];
    //$this->cus_contact = $row['cus_contact'];
	
}
// used get single pricing by productid and process
function readOnebyid(){
 
    // query to read single record
    $query = "SELECT *  FROM
                " . $this->table_name . " WHERE id = ? 				
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
	return $stmt;
    // get retrieved row
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    //$this->cus_first_name = $row['cus_first_name'];
    //$this->cus_email = $row['cus_email'];
    //$this->cus_contact = $row['cus_contact'];
	
}
// update() method will be here
// update a user record
public function update(){
 
    // if password needs to be updated
    //$password_set=!empty($this->password) ? ", password = :password" : "";
 
    // if no posted password, do not update the password
    $query = "UPDATE " . $this->table_name . "
            SET
                product_process = :product_process,
                product_cost = :product_cost,
                status = :status
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->product_process=htmlspecialchars(strip_tags($this->product_process));
    $this->product_cost=htmlspecialchars(strip_tags($this->product_cost));
    $this->status=htmlspecialchars(strip_tags($this->status));
 
    // bind the values  
    $stmt->bindParam(':product_process', $this->product_process);
    $stmt->bindParam(':product_cost', $this->product_cost);
	$stmt->bindParam(':status', $this->status);  
    
 
    // hash the password before saving to database
    /*if(!empty($this->password)){
        $this->password=htmlspecialchars(strip_tags($this->password));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
    }*/
 
    // unique ID of record to be edited
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// delete customer
function delete1(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
function deleteone(){
 
    // query to read single record
    $query = "DELETE  FROM
                " . $this->table_name . " WHERE id = ? ";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute())
	{
	return true;
	}
	return false;
    // get retrieved row
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    //$this->cus_first_name = $row['cus_first_name'];
    //$this->cus_email = $row['cus_email'];
    //$this->cus_contact = $row['cus_contact'];
	
}
}