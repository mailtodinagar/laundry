<?php
// 'user' object
class expenses{
 
    // database connection and table name
    private $conn;
    private $table_name = "expense_sheet";
	
    // object properties
    public $id;
    public $entry_date;
    public $exp_amount;
    public $exp_reason;
    public $exp_desc; 
 
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
                entry_date = :entry_date,
                exp_amount = :exp_amount,
                exp_reason = :exp_reason,				
                exp_desc = :exp_desc";

    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->entry_date=htmlspecialchars(strip_tags($this->entry_date));
    $this->exp_amount=htmlspecialchars(strip_tags($this->exp_amount));
    $this->exp_reason=htmlspecialchars(strip_tags($this->exp_reason));
    $this->exp_desc=htmlspecialchars(strip_tags($this->exp_desc));
	
    // bind the values
    $stmt->bindParam(':entry_date', $this->entry_date);
    $stmt->bindParam(':exp_amount', $this->exp_amount);
    $stmt->bindParam(':exp_reason', $this->exp_reason);
	$stmt->bindParam(':exp_desc', $this->exp_desc);
 
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
    $query = "SELECT customer_id, cus_contact, cus_email
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


 // showrecord() method will be here
// list out all records in user table
function showCustomers(){
 
    // query to check if email exists
    $query = "SELECT * FROM " . $this->table_name . "order by createdat";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );

    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
		
		// products array
    $products_arr=array();
    $products_arr["records"]=array();
 
        // get record details / values
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 //``, ``, ``, ``, `cus_contact`, 
  //`cus_type`, `cus_gender`, `cus_address`, `cus_img`, `wallet_amt`, `status`
        // assign values to object properties
      $product_item=array(
            "id" => $row['id'],
			"customer_id" => $row['customer_id'],
			"cus_first_name" => $row['cus_first_name'],
			"cus_last_name" => $row['cus_last_name'],			
            "cus_email" => $row['cus_email']
        );
 
        array_push($products_arr["records"], $product_item);
		}
		// set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
        // return true because email exists in the database
        return true;
    }
	// set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
    // return false if email does not exist in the database
    return false;
}
function fetch_all()
	{
		$query = "SELECT * FROM " . $this->table_name . " ORDER BY createdat DESC";
		$statement = $this->conn->prepare($query);
		/*if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}*/
		$statement->execute();
		return $statement;
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
public function update(){
 
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
}