<?php

//Get the server access details
require_once('config.php');


class Connection {
    private $connect = null;
    
    public function __construct() {
        $this->openConnect();
    }

    public function openConnect() {
        
        try {
            
            //Create connection
            $this->connect = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);

            //Set Attributes
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           //Return the connection
           return 'Successful'; 

        } catch (Exception $ex) {
            //throw exception 
            return "Connection failed: ".$ex->getMessage();
        }
    }

    public function closeConnect() {
        try {
            //Close connection
            unset($this->connect);

           //Return a response
           return true; 

        } catch (Exception $ex) {
            //throw exception 
            return "Connection NOT closed: ".$ex->getMessage();
        }
    }


	/**
	 * @return mixed
	 */
	public function getConnect() {
		return $this->connect;
	}
}