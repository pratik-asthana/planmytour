<?php

class DB
{

    protected $db_host;
    protected $db_username;
    protected $db_password;
    protected $db_database;
    protected $db_connection = null;
    
       
    public function __construct($db_host = "sql109.byetcluster.com", $db_username = "unaux_23319380", $db_password = "qtb6omcw9ayxy", $db_database = "unaux_23319380_apilisting"){
        $this->db_host     = $db_host;
        
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->db_database = $db_database;
        // $this->db_table    = $db_table;
    }

    protected function db_connect(){
      
		if(is_null($this->db_connection)){
			try 
			{
				$this->db_connection = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_database);
			
				if(	$this->db_connection->connect_error){
					throw new \Exception("Connection failed: " . $this->db_connection->connect_error);
				}
			} catch(\Exception $e){
				die("<h1>DATABASE ERROR : <br><hr><br></h1><h3>{$e->getMessage()}</h3>");
			}
		}
	}
	
	protected function db_close(){
 		$this->db_connection->close();
	}
	
	public function __destruct(){
		$this->db_close();
	}	
	
	
	public function executeQuery($query){
	    try{
	        
	        $this->db_connect();
	        
	        $result = $this->db_connection->query($query);
	        
	        if(!$result)
	            throw new \Exception(sprintf("Error: %s\n", $this->db_connection->error));
	            
	        return $result;    
	                   
	    } catch (\Exception $e) {
	        die("<h1>QUERY EXECUTION ERROR : <br><hr><br></h1><h3>{$e->getMessage()}</h3>");
	    }
	}
}

