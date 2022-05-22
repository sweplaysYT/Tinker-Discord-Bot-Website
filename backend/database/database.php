<?php

class Database {

  private $address;
  private $user;
  private $password;
  private $database;

  public function __construct() {
    $address = getenv('DATABASE_ADDRESS');
    $user = getenv('DATABASE_USER');
    $password = getenv('DATABASE_PASSWORD');
    $database = getenv('DATABASE');
  }
  
  public function connect() {
    try {
      $connection = new PDO("mysql:host=$this->address;dbname=$this->database;port:3306",
                            $this->user,
                            $this->password
                          );

      $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //$conn -> close();
    } catch (PDOException $e) {
      echo "Connection failed: " . $e -> getMessage();
    }
  }
}

?>