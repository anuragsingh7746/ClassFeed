<?php 
include_once('DbConnection.php');

class Admin extends DbConnection{
    public function __construct(){
        parent::__construct();
    }
    

    public function run_query($sql_query){
        $query = $this->conn->query($sql_query);
        return $query;
    }    
} 
?>
