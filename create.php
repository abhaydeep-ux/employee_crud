
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/database.php";
require_once "models/crud.php";

$database = new Database();

$crud = new Crud($database);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "department" => $_POST["department"],
        "salary" => $_POST["salary"]
    ];

    $data = $crud->create($data);

    $result = $crud->insert("employees", $data);

    if ($result) {

        echo "Employee added ";

    } else {

        echo "Employee insert failed";
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Add Employee</title>

    <link rel="stylesheet" href="css/create.css">

</head>

<body>

<h2>Add Employee</h2>

<form method="POST">

    <label>Name:</label>

    <input type="text" name="name">

    <br><br>

    <label>Email:</label>

    <input type="email" name="email">

    <br><br>

    <label>Phone:</label>

    <input type="text" name="phone">

    <br><br>

    <label>Department:</label>

    <input type="text" name="department">

    <br><br>

    <label>Salary:</label>

    <input type="number" name="salary">

    <br><br>

    <button type="submit">Add Employee</button>

</form>

</body>

</html>


