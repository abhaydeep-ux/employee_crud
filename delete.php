<?php

require_once "config/database.php";
require_once "models/crud.php";

$database = new Database();

$crud = new Crud($database);

$id = $_GET["id"];

$result = $crud->delete( "employees", $id);

if ($result) {
    header("Location: index.php");
    exit;
} else {
    echo "Employee  failed";
}