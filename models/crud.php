<?php

require_once __DIR__ . "/../config/database.php";

# Employee class to handle CRUD operations for employees

class Crud {
    private $database;

    # Constructor to initialize the database connection

    public function __construct(Database  $database)  {
        $this->database = $database->connect();
    }

    public function create($data){
        return $data;
    }

    public function insert($table ,  $data){
       $colums = array_keys($data);
       $values = array_values($data);
       $columslist = implode(", " , $colums);
       $placeholders = implode(", " , array_fill(0 , count($values) , "?"));    
       $query = "INSERT INTO $table ($columslist) VALUES ($placeholders)";
       $statement = $this->database->prepare($query);

       $types = "";

        foreach ($values as $value) {
           if (is_int($value)) {
               $types .= "i";
           } elseif (is_float($value)) {
               $types .= "d";
           } elseif (is_string($value)) {
               $types .= "s";
           } else {
               $types .= "b";
           }
        }
        $statement->bind_param($types, ...$values);
        return $statement->execute();
    }

    public function select($table){
        $query = "SELECT * FROM $table
        WHERE deleted_at IS NULL";
        $statement = $this->database->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    
    public function update($table, $data, $id){
    $columns = array_keys($data);

    $values = array_values($data);

    $setParts = [];

    foreach ($columns as $column) {

        $setParts[] = "$column = ?";
    }

    $setQuery = implode(", ", $setParts);

    $query = "UPDATE $table SET $setQuery WHERE id = ?";

    $statement = $this->database->prepare($query);

    $values[] = $id;

    $types = "";

    foreach ($values as $value) {

        if (is_int($value)) {
            $types .= "i";
        } elseif (is_float($value)) {
            $types .= "d";
        } else {
            $types .= "s";
        }
    }

    $statement->bind_param($types, ...$values);

    return $statement->execute();
   }

   
    public function delete($table, $id) {

    $query = "UPDATE $table
              SET deleted_at = NOW()
              WHERE id = ?";

    $statement = $this->database->prepare($query);

    $statement->bind_param("i", $id);

    return $statement->execute();

}

// testing SourceTree
public function restore($table, $id) {

    $query = "UPDATE $table
              SET deleted_at = NULL
              WHERE id = ?";

    $statement = $this->database->prepare($query);

    $statement->bind_param("i", $id);

    return $statement->execute();

}


}






