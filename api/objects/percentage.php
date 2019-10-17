<?php
// 'user' object
class percentage{
 
    // database connection and table name
    private $conn;
    private $table_name = "percentage_config";

    // object properties
    public $id;
    public $process_type;
    public $inc_percentage;
    public $small_desc;     
 
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
                process_type = :process_type,
                inc_percentage = :inc_percentage,
                small_desc = :small_desc";			
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->process_type=htmlspecialchars(strip_tags($this->process_type));
    $this->inc_percentage=htmlspecialchars(strip_tags($this->inc_percentage));
    $this->small_desc=htmlspecialchars(strip_tags($this->small_desc));
	
    // bind the values
    $stmt->bindParam(':process_type', $this->process_type);
    $stmt->bindParam(':inc_percentage', $this->inc_percentage);
    $stmt->bindParam(':small_desc', $this->small_desc);

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
                " . $this->table_name . " WHERE process_type = ? 
				OR 
				 inc_percentage = ? 				
            LIMIT
                0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
	$this->process_type=htmlspecialchars(strip_tags($this->process_type));
    $this->inc_percentage=htmlspecialchars(strip_tags($this->inc_percentage));
 
    // bind given email value
    $stmt->bindParam(1, $this->process_type);
	 $stmt->bindParam(2, $this->inc_percentage);
 
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
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY createdat";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// used get single product by id
function readOne(){
 
    // query to read single record
    $query = "SELECT *  FROM
                " . $this->table_name . " WHERE process_type = ?
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
// used get single product by id
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
                process_type = :process_type,
                inc_percentage = :inc_percentage,
                small_desc = :small_desc,
				status = :status               
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->process_type=htmlspecialchars(strip_tags($this->process_type));
    $this->inc_percentage=htmlspecialchars(strip_tags($this->inc_percentage));
    $this->small_desc=htmlspecialchars(strip_tags($this->small_desc));
	$this->status=htmlspecialchars(strip_tags($this->status));
 
    // bind the values  
    $stmt->bindParam(':process_type', $this->process_type);
    $stmt->bindParam(':inc_percentage', $this->inc_percentage);
	$stmt->bindParam(':small_desc', $this->small_desc);
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
//delete record using id
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