<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "laundry_app";
    private $username = "root";
    private $password = "";
	
	/*private $host = "148.72.232.174";
    private $db_name = "laundry_app";
    private $username = "laundry_app_2019";
    private $password = "Avsj0%68";
    public $conn;*/
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>