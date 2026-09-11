```php
<?php

require_once "config/database.php";
require_once "models/crud.php";

$database = new Database();
$crud = new Crud($database);

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "department" => $_POST["department"],
        "salary" => $_POST["salary"]
    ];

    $result = $crud->update(
        "employees",
        $data,
        $id
    );

    if ($result) {

        header("Location: index.php");
        exit;

    } else {

        echo "Employee update failed";

    }

}

$employees = $crud->select("employees");

while ($row = $employees->fetch_assoc()) {

    if ($row["id"] == $id) {

        $name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
        $department = $row["department"];
        $salary = $row["salary"];

        break;
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Employee Feature Page</title>

    <link rel="stylesheet" href="css/edit.css">

</head>

<body>


<h2>Edit Employee</h2>

<form method="POST">

    <label>Name:</label>

    <input type="text" name="name" value="<?php echo $name; ?>">

    <br><br>

    <label>Email:</label>

    <input type="email" name="email" value="<?php echo $email; ?>">

    <br><br>

    <label>Phone:</label>

    <input type="text" name="phone" value="<?php echo $phone; ?>">

    <br><br>

    <label>Department:</label>

    <input type="text" name="department" value="<?php echo $department; ?>">

    <br><br>

    <label>Salary:</label>

    <input type="number" name="salary" value="<?php echo $salary; ?>">

    <br><br>

    <button type="submit">Update Employee</button>

</form>

</body>

</html>
```
