<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/database.php";
require_once "models/crud.php";

$database = new Database();
$connection = $database->connect();

if ($connection) {
    echo "Database connected successfully";
}
$crud = new Crud($database);

$employees = $crud->select("employees");

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Employees</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<h2>Employee List</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Department</th>
        <th>Salary</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $employees->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["phone"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
            <td>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>

    <?php } ?>

</table>

</body>
</html>


