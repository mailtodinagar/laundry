<?php
// 'user' object
class customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "shop_customers";

    // object properties
    public $id;
    public $customer_id;
    public $cus_first_name;
    public $cus_last_name;
    public $cus_email;
	public $cus_contact;
    public $cus_type;
    public $cus_gender;
    public $cus_address;
    public $wallet_amt;
 
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
                customer_id = :customer_id,
                cus_first_name = :cus_first_name,
                cus_last_name = :cus_last_name,				
                cus_email = :cus_email,
				cus_contact = :cus_contact,
                cus_type = :cus_type,
				cus_gender = :cus_gender,
                cus_address = :cus_address,
				wallet_amt = :wallet_amt";              
                
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
    $this->cus_first_name=htmlspecialchars(strip_tags($this->cus_first_name));
    $this->cus_last_name=htmlspecialchars(strip_tags($this->cus_last_name));
    $this->cus_email=htmlspecialchars(strip_tags($this->cus_email));
	$this->cus_contact=htmlspecialchars(strip_tags($this->cus_contact));
    $this->cus_type=htmlspecialchars(strip_tags($this->cus_type));
    $this->cus_gender=htmlspecialchars(strip_tags($this->cus_gender));
    $this->cus_address=htmlspecialchars(strip_tags($this->cus_address));
	$this->wallet_amt=htmlspecialchars(strip_tags($this->wallet_amt));
 
    // bind the values
    $stmt->bindParam(':customer_id', $this->customer_id);
    $stmt->bindParam(':cus_first_name', $this->cus_first_name);
    $stmt->bindParam(':cus_last_name', $this->cus_last_name);
	$stmt->bindParam(':cus_email', $this->cus_email);
    $stmt->bindParam(':cus_contact', $this->cus_contact);
    $stmt->bindParam(':cus_type', $this->cus_type);
	$stmt->bindParam(':cus_gender', $this->cus_gender);
    $stmt->bindParam(':cus_address', $this->cus_address);
    $stmt->bindParam(':wallet_amt', $this->wallet_amt);
 
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
                " . $this->table_name . " WHERE customer_id = ? 
				OR 
				 cus_email = ? 
				OR 
				 cus_contact = ?
            LIMIT
                0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
	$this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
    $this->cus_email=htmlspecialchars(strip_tags($this->cus_email));
	$this->cus_contact=htmlspecialchars(strip_tags($this->cus_contact));
 
    // bind given email value
    $stmt->bindParam(1, $this->customer_id);
	 $stmt->bindParam(2, $this->cus_email);
	 $stmt->bindParam(3, $this->cus_contact);
 
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
                " . $this->table_name . " WHERE customer_id = ?
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
// used get single customer by customerid
function getId(){
 
    // query to read single record
    $query = "SELECT customer_id  FROM
                " . $this->table_name . " ORDER BY createdat DESC
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
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
                cus_first_name = :cus_first_name,
                cus_last_name = :cus_last_name,
                cus_email = :cus_email,
				cus_contact = :cus_contact,
                cus_type = :cus_type,
                cus_gender = :cus_gender,
				cus_address = :cus_address,
                wallet_amt = :wallet_amt
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->cus_first_name=htmlspecialchars(strip_tags($this->cus_first_name));
    $this->cus_last_name=htmlspecialchars(strip_tags($this->cus_last_name));
    $this->cus_email=htmlspecialchars(strip_tags($this->cus_email));
	$this->cus_contact=htmlspecialchars(strip_tags($this->cus_contact));
    $this->cus_type=htmlspecialchars(strip_tags($this->cus_type));
    $this->cus_gender=htmlspecialchars(strip_tags($this->cus_gender));
    $this->cus_address=htmlspecialchars(strip_tags($this->cus_address));
	$this->wallet_amt=htmlspecialchars(strip_tags($this->wallet_amt));
 
    // bind the values  
    $stmt->bindParam(':cus_first_name', $this->cus_first_name);
    $stmt->bindParam(':cus_last_name', $this->cus_last_name);
	$stmt->bindParam(':cus_email', $this->cus_email);
    $stmt->bindParam(':cus_contact', $this->cus_contact);
    $stmt->bindParam(':cus_type', $this->cus_type);
	$stmt->bindParam(':cus_gender', $this->cus_gender);
    $stmt->bindParam(':cus_address', $this->cus_address);
    $stmt->bindParam(':wallet_amt', $this->wallet_amt);    
    
 
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