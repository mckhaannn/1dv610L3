<?php

namespace model;

require_once('databaseInformation.php');

class Database {

  private $dbServername;
  private $dbUsername;
  private $dbPassword;
  private $dbname;

  public function __construct() 
  {
    $this->dbServername = SERVER_NAME;
    $this->dbUsername = DB_USERNAME;
    $this->dbPassword = DB_PASSWORD;
    $this->dbname = DB_NAME;
    
  }
  public function server() {
    try {
      $connection = new \PDO("mysql:host={$this->dbServername};dbname={$this->dbname};", $this->dbUsername, $this->dbPassword);
    } catch(Exception $e) {
      echo $e->getMessage();
    }
    return $connection;
  }
}


  
