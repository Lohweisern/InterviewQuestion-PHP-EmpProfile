<?php
$file = "employees.json";
$employees = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $employees = json_decode($json, true);
}

$search = strtolower($_GET['search'] ?? '');
$filtered = array_filter($employees, function ($emp) use ($search) {
    return !$search ||
        strpos(strtolower($emp['name']), $search) !== false ||
        strpos(strtolower($emp['department']), $search) !== false;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Employee Records</title>
  <style>
    /* Container */
    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
      font-family: Arial, sans-serif;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 28px;
      font-weight: 700;
    }

    /* Search Box */
    .search-box {
      text-align: center;
      margin-bottom: 30px;
    }

    .search-box form {
      display: inline-flex;
      gap: 8px;
      width: 100%;
      max-width: 400px;
    }

    .search-box input[type="text"] {
      flex-grow: 1;
      padding: 10px 12px;
      font-size: 15px;
      border: 1.5px solid #ccc;
      border-radius: 6px;
      transition: border-color 0.3s ease;
    }
    .search-box input[type="text"]:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
    }

    .search-box button.btn {
      padding: 10px 20px;
      font-size: 15px;
      font-weight: 600;
      background-color: #007bff;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .search-box button.btn:hover {
      background-color: #0056b3;
    }

    /* Table */
    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      font-size: 14px;
    }

    thead {
      background-color: #007bff;
      color: white;
      font-weight: 600;
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #e0e0e0;
      text-align: left;
      vertical-align: middle;
      white-space: nowrap;
    }

    tbody tr:hover {
      background-color: #f1f8ff;
    }

    /* Back Button */
    .btn-back {
      display: inline-block;
      margin-top: 40px;
      padding: 12px 28px;
      font-size: 16px;
      font-weight: 700;
      background-color: #6c757d;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .btn-back:hover {
      background-color: #5a6268;
    }

    /* Responsive */
    @media (max-width: 720px) {
      th, td {
        font-size: 12px;
        padding: 8px 10px;
      }
      .action-buttons {
        flex-direction: column;
      }
      .action-buttons a.btn,
      .action-buttons button.btn,
      form.inline-form {
        flex: none;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Employee Records</h2>

    <!-- Search Box -->
    <div class="search-box">
      <form method="GET">
        <input
          type="text"
          name="search"
          placeholder="Search by name or department..."
          value="<?= htmlspecialchars($search) ?>"
          aria-label="Search employees"
        />
        <button type="submit" class="btn">Search</button>
      </form>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
      <?php if (count($filtered) > 0): ?>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Gender</th>
              <th>Status</th>
              <th>Phone</th>
              <th>Email</th>
              <th>D.O.B</th>
              <th>Department</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($filtered as $index => $emp): ?>
              <tr>
                <td><?= htmlspecialchars($emp['name']) ?></td>
                <td><?= htmlspecialchars($emp['gender']) ?></td>
                <td><?= htmlspecialchars($emp['marital_status']) ?></td>
                <td><?= htmlspecialchars($emp['phone']) ?></td>
                <td><?= htmlspecialchars($emp['email']) ?></td>
                <td><?= htmlspecialchars($emp['dob']) ?></td>
                <td><?= htmlspecialchars($emp['department']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No matching employee records found.</p>
      <?php endif; ?>
    </div>

    <!-- Back Button -->
    <div style="text-align: center;">
      <a href="index.html" class="btn-back">← Back to Add Form</a>
    </div>
  </div>
</body>
</html>
