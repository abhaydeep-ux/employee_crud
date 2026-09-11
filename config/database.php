<?php
# Database class to handle database connection

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "employee_crud";

    private $connection;

    public function connect()  {

       $this->connection = new mysqli(
        $this->host,
        $this->username,
        $this->password,
        $this->database
       );
       if ($this->connection->connect_error) {
          die ("Database connection failed: " . $this->connection->connect_error);
       }
       return $this->connection;
    }
}