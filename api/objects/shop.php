<?php
// 'user' object
class shop{
 
    // database connection and table name
    private $conn;
    private $table_name = "shop_details";

    // object properties
    public $id;
    public $shop_name;
    public $shop_country;
    public $tax_no;
    public $tax_percentage;
	public $shop_address;
    public $shop_desc;    
 
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
                shop_name = :shop_name,
                shop_country = :shop_country,
                tax_no = :tax_no,				
                tax_percentage = :tax_percentage,
				shop_address = :shop_address,
                shop_desc = :shop_desc";				          
                
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->shop_name=htmlspecialchars(strip_tags($this->shop_name));
    $this->shop_country=htmlspecialchars(strip_tags($this->shop_country));
    $this->tax_no=htmlspecialchars(strip_tags($this->tax_no));
    $this->tax_percentage=htmlspecialchars(strip_tags($this->tax_percentage));
	$this->shop_address=htmlspecialchars(strip_tags($this->shop_address));
    $this->shop_desc=htmlspecialchars(strip_tags($this->shop_desc));
	
    // bind the values
    $stmt->bindParam(':shop_name', $this->shop_name);
    $stmt->bindParam(':shop_country', $this->shop_country);
    $stmt->bindParam(':tax_no', $this->tax_no);
	$stmt->bindParam(':tax_percentage', $this->tax_percentage);
    $stmt->bindParam(':shop_address', $this->shop_address);
    $stmt->bindParam(':shop_desc', $this->shop_desc);	
 
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
    $query = "SELECT customer_id, tax_percentage, cus_email
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->cus_email=htmlspecialchars(strip_tags($this->cus_email));
 
    // bind given email value
    $stmt->bindParam(1, $this->cus_email);
 
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
        $this->cus_contact = $row['cus_contact'];
        $this->cus_email = $row['cus_email'];       
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

 // read customers
function read(){

 
    // select all query
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY createdat";
 
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
                shop_name = :shop_name,
                shop_country = :shop_country,
                tax_no = :tax_no,
				tax_percentage = :tax_percentage,
                shop_address = :shop_address,
                shop_desc = :shop_desc			
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->shop_name=htmlspecialchars(strip_tags($this->shop_name));
    $this->shop_country=htmlspecialchars(strip_tags($this->shop_country));
    $this->tax_no=htmlspecialchars(strip_tags($this->tax_no));
	$this->tax_percentage=htmlspecialchars(strip_tags($this->tax_percentage));
    $this->shop_address=htmlspecialchars(strip_tags($this->shop_address));
    $this->shop_desc=htmlspecialchars(strip_tags($this->shop_desc));
 
    // bind the values  
    $stmt->bindParam(':shop_name', $this->shop_name);
    $stmt->bindParam(':shop_country', $this->shop_country);
	$stmt->bindParam(':tax_no', $this->tax_no);
    $stmt->bindParam(':tax_percentage', $this->tax_percentage);
    $stmt->bindParam(':shop_address', $this->shop_address);
	$stmt->bindParam(':shop_desc', $this->shop_desc);  
    
 
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