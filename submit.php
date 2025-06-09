<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "name" => htmlspecialchars(trim($_POST["name"])),
        "gender" => $_POST["gender"],
        "marital_status" => $_POST["marital_status"],
        "phone" => htmlspecialchars(trim($_POST["phone"])),
        "email" => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
        "address" => htmlspecialchars(trim($_POST["address"])),
        "dob" => $_POST["dob"],
        "nationality" => htmlspecialchars(trim($_POST["nationality"])),
        "hire_date" => $_POST["hire_date"],
        "department" => htmlspecialchars(trim($_POST["department"]))
    ];

    // Basic backend validation
    if (!preg_match("/^\+?[0-9]{10,15}$/", $data["phone"])) {
        die("Invalid phone number format.");
    }

    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $file = "employees.json";
    $employees = [];

    if (file_exists($file)) {
        $existing = file_get_contents($file);
        $employees = json_decode($existing, true) ?: [];
    }

    $employees[] = $data;
    file_put_contents($file, json_encode($employees, JSON_PRETTY_PRINT));

    header("Location: view_employees.php");
    exit();
}
?>
