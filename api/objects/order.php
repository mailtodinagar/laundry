<?php
// 'user' object
class order{
 
    // database connection and table name
    private $conn;
    private $table_name = "my_orders";

    // object properties
    public $id;
    public $order_id;
    public $customer_id;
    public $customer_name;
    public $customer_contact;
	public $process_type;
    public $tax_percentage;
    public $tax_amount;
    public $discount_percentage;
    public $discount_amount;
	public $total_qty;
    public $net_amount;
    public $payable_amount;
 
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
                order_id = :order_id,
                customer_id = :customer_id,
                customer_name = :customer_name,				
                customer_contact = :customer_contact,
				process_type = :process_type,
                tax_percentage = :tax_percentage,
				tax_amount = :tax_amount,
                discount_percentage = :discount_percentage,
				discount_amount = :discount_amount,
				total_qty = :total_qty,
				net_amount = :net_amount,
				payable_amount = :payable_amount";              
                
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->order_id=htmlspecialchars(strip_tags($this->order_id));
    $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
    $this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
    $this->customer_contact=htmlspecialchars(strip_tags($this->customer_contact));
	$this->process_type=htmlspecialchars(strip_tags($this->process_type));
    $this->tax_percentage=htmlspecialchars(strip_tags($this->tax_percentage));
    $this->tax_amount=htmlspecialchars(strip_tags($this->tax_amount));
    $this->discount_percentage=htmlspecialchars(strip_tags($this->discount_percentage));
	$this->discount_amount=htmlspecialchars(strip_tags($this->discount_amount));
	$this->total_qty=htmlspecialchars(strip_tags($this->total_qty));
    $this->net_amount=htmlspecialchars(strip_tags($this->net_amount));
	$this->payable_amount=htmlspecialchars(strip_tags($this->payable_amount));
 
    // bind the values
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':customer_id', $this->customer_id);
    $stmt->bindParam(':customer_name', $this->customer_name);
	$stmt->bindParam(':customer_contact', $this->customer_contact);
    $stmt->bindParam(':process_type', $this->process_type);
    $stmt->bindParam(':tax_percentage', $this->tax_percentage);
	$stmt->bindParam(':tax_amount', $this->tax_amount);
    $stmt->bindParam(':discount_percentage', $this->discount_percentage);
    $stmt->bindParam(':discount_amount', $this->discount_amount);
	$stmt->bindParam(':total_qty', $this->total_qty);
    $stmt->bindParam(':net_amount', $this->net_amount);
    $stmt->bindParam(':payable_amount', $this->payable_amount);
 
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
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT customer_id, process_type, customer_contact
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->customer_contact=htmlspecialchars(strip_tags($this->customer_contact));
 
    // bind given email value
    $stmt->bindParam(1, $this->customer_contact);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->customer_id = $row['customer_id'];
        $this->process_type = $row['process_type'];
        $this->customer_contact = $row['customer_contact'];       
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

 // read customers
function read(){

 
    // select all query
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY createdat DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// used get single customer by customerid
function readOne(){
 
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
    //$this->customer_contact = $row['customer_contact'];
    //$this->process_type = $row['process_type'];
	
}

// update() method will be here
// update a user record
public function update(){
 
    // if password needs to be updated
    //$password_set=!empty($this->password) ? ", password = :password" : "";
 
    // if no posted password, do not update the password
    $query = "UPDATE " . $this->table_name . "
            SET
                status = :status                
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->status=htmlspecialchars(strip_tags($this->status));
   
 
    // bind the values  
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
    //$this->customer_contact = $row['customer_contact'];
    //$this->process_type = $row['process_type'];
}
}