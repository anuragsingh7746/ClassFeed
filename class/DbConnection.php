<?php 

class DbConnection{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '_Sumit1.';
    private $db = 'feedback_system_3.0';

    protected $conn;

    public function __construct(){
        if(!isset($this->conn)){
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            if(!$this->conn){
                echo "Error connecting to the server";
                exit;
            }
            date_default_timezone_set('Asia/Kolkata');
        }

        return $this->conn;
    }
        
}

?>
