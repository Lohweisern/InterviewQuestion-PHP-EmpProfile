<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'name' => $_POST['name'],
    'gender' => $_POST['gender'],
    'marital_status' => $_POST['marital_status'],
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'address' => $_POST['address'],
    'dob' => $_POST['dob'],
    'nationality' => $_POST['nationality'],
    'hire_date' => $_POST['hire_date'],
    'department' => $_POST['department']
  ];

  $file = 'employees.json';
  $employees = [];

  // Read existing data
  if (file_exists($file)) {
    $json = file_get_contents($file);
    $employees = json_decode($json, true) ?: [];
  }

  // Add new record
  $employees[] = $data;

  // Save updated data
  file_put_contents($file, json_encode($employees, JSON_PRETTY_PRINT));

  exit;
}
?>
