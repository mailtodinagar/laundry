<?php
// 'user' object
class staff{
 
    // database connection and table name
    private $conn;
    private $table_name = "staff_config";

    // object properties
    public $id;
    public $staff_id;
    public $staff_name;
    public $staff_surname;
    public $staff_username;
	public $staff_password;
    public $staff_email;    
	public $staff_phone;
    public $staff_dob;
    public $staff_doj;
	public $staff_img;
    public $staff_permission;  
	public $staff_address;
 
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
                staff_id = :staff_id,
                staff_name = :staff_name,
                staff_surname = :staff_surname,				
                staff_username = :staff_username,
				staff_password = :staff_password,
				staff_email = :staff_email,
				staff_phone = :staff_phone,
				staff_dob = :staff_dob,
				staff_doj = :staff_doj,
				staff_permission = :staff_permission,
				staff_address = :staff_address";                			          
                
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->staff_id=htmlspecialchars(strip_tags($this->staff_id));
    $this->staff_name=htmlspecialchars(strip_tags($this->staff_name));
    $this->staff_surname=htmlspecialchars(strip_tags($this->staff_surname));
    $this->staff_username=htmlspecialchars(strip_tags($this->staff_username));
	$this->staff_password=htmlspecialchars(strip_tags($this->staff_password));
    $this->staff_email=htmlspecialchars(strip_tags($this->staff_email));
	$this->staff_password=htmlspecialchars(strip_tags($this->staff_password));
    $this->staff_phone=htmlspecialchars(strip_tags($this->staff_phone));
	$this->staff_dob=htmlspecialchars(strip_tags($this->staff_dob));
    $this->staff_doj=htmlspecialchars(strip_tags($this->staff_doj));
	$this->staff_permission=htmlspecialchars(strip_tags($this->staff_permission));
    $this->staff_address=htmlspecialchars(strip_tags($this->staff_address));
	
    // bind the values
    $stmt->bindParam(':staff_id', $this->staff_id);
    $stmt->bindParam(':staff_name', $this->staff_name);
    $stmt->bindParam(':staff_surname', $this->staff_surname);
	$stmt->bindParam(':staff_username', $this->staff_username);
    $stmt->bindParam(':staff_email', $this->staff_email);
    $stmt->bindParam(':staff_phone', $this->staff_phone);
	$stmt->bindParam(':staff_dob', $this->staff_dob);
    $stmt->bindParam(':staff_doj', $this->staff_doj);
	$stmt->bindParam(':staff_permission', $this->staff_permission);
    $stmt->bindParam(':staff_address', $this->staff_address);	
 
    // hash the password before saving to database
    $password_hash = password_hash($this->staff_password, PASSWORD_BCRYPT);
    $stmt->bindParam(':staff_password', $password_hash);
 
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
                " . $this->table_name . " WHERE staff_id = ? 
				OR 
				 staff_email = ? 
				OR 
				 staff_username = ?
				OR 
				 staff_phone = ?
            LIMIT
                0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
	$this->staff_id=htmlspecialchars(strip_tags($this->staff_id));
    $this->staff_email=htmlspecialchars(strip_tags($this->staff_email));
	$this->staff_username=htmlspecialchars(strip_tags($this->staff_username));
	$this->staff_phone=htmlspecialchars(strip_tags($this->staff_phone));
 
    // bind given email value
    $stmt->bindParam(1, $this->customer_id);
	 $stmt->bindParam(2, $this->staff_email);
	 $stmt->bindParam(3, $this->staff_username);
	 $stmt->bindParam(4, $this->staff_phone);
 
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

// update() method will be here
// update a user record
public function update1(){
 
    // if password needs to be updated
    $password_set=!empty($this->password) ? ", password = :password" : "";
 
    // if no posted password, do not update the password
    $query = "UPDATE " . $this->table_name . "
            SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email
                {$password_set}
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind the values from the form
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
 
    // hash the password before saving to database
    if(!empty($this->password)){
        $this->password=htmlspecialchars(strip_tags($this->password));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
    }
 
    // unique ID of record to be edited
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
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
                staff_name = :staff_name,
                staff_surname = :staff_surname,
                staff_username = :staff_username,
				staff_password = :staff_password,
                staff_email = :staff_email,
                staff_phone = :staff_phone,
				staff_dob = :staff_dob,
				staff_doj = :staff_doj,
				staff_permission = :staff_permission,
				staff_address = :staff_address,
                status = :status
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
	$this->staff_name=htmlspecialchars(strip_tags($this->staff_name));
    $this->staff_surname=htmlspecialchars(strip_tags($this->staff_surname));
    $this->staff_username=htmlspecialchars(strip_tags($this->staff_username));	
    $this->staff_email=htmlspecialchars(strip_tags($this->staff_email));
    $this->staff_phone=htmlspecialchars(strip_tags($this->staff_phone));
    $this->staff_dob=htmlspecialchars(strip_tags($this->staff_dob));
	$this->staff_doj=htmlspecialchars(strip_tags($this->staff_doj));	
	    $this->staff_permission=htmlspecialchars(strip_tags($this->staff_permission));
    $this->staff_address=htmlspecialchars(strip_tags($this->staff_address));
	$this->status=htmlspecialchars(strip_tags($this->status));
 
    // bind the values  
    $stmt->bindParam(':staff_name', $this->staff_name);
    $stmt->bindParam(':staff_surname', $this->staff_surname);
	$stmt->bindParam(':staff_username', $this->staff_username);  
    $stmt->bindParam(':staff_email', $this->staff_email);
	$stmt->bindParam(':staff_phone', $this->staff_phone);
    $stmt->bindParam(':staff_dob', $this->staff_dob);
    $stmt->bindParam(':staff_doj', $this->staff_doj); 	
	$stmt->bindParam(':staff_permission', $this->staff_permission);
    $stmt->bindParam(':staff_address', $this->staff_address);
    $stmt->bindParam(':status', $this->status);  	
    
 
    // hash the password before saving to database
    if(!empty($this->staff_password)){
        $this->staff_password=htmlspecialchars(strip_tags($this->staff_password));
        $password_hash = password_hash($this->staff_password, PASSWORD_BCRYPT);
        $stmt->bindParam(':staff_password', $password_hash);
    }
 
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