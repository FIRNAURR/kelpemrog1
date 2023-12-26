<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Vehicle Service</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
<body>
<div class="container mt-5">
<h2>VIN Info</h2>
<a href="../index.php"><button type="button" class="btn btn-outline-primary">Back to Main Menu</button></a>
 <?php
// Include database connection
include('../config/konfig.php');


session_start();
if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']); // Clear the session variable
}

// Fetch data from the database
$result = mysqli_query($conn, "SELECT vin.vehicle_id, vin.vin, vin.license_plate, vin.customers_id, vin.model_id, vin.manufactured_year, vin.manufactured_month, vin.details, cutomers.id_customers, model.id, cutomers.first_name, model.model_name FROM vin
    INNER JOIN cutomers ON vin.customers_id = cutomers.id_customers
    INNER JOIN model ON vin.model_id = model.id");

if (mysqli_num_rows($result) == 0) {
    echo "Data empty";
} else {
    // Start table
    echo "<table class='table'>";
    
    // Output table headers
    echo "<tr>";
    echo "<th>VEHICLE ID</th>";
    echo "<th>VIN</th>";
    echo "<th>LICENSE PLATE</th>";
    echo "<th>CUSTOMERS NAME</th>";
    echo "<th>MODEL NAME</th>";
    echo "<th>MANUFACTURED YEAR</th>";
    echo "<th>MANUFACTURED MONTH</th>";
    echo "<th>DETAIL</th>";
    echo "<th>ACTION</th>";
    echo "</tr>";

    // Output data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['vehicle_id'] . "</td>";
        echo "<td>" . $row['vin'] . "</td>";
        echo "<td>" . $row['license_plate'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['model_name'] . "</td>";
        echo "<td>" . $row['manufactured_year'] . "</td>";
        echo "<td>" . $row['manufactured_month'] . "</td>";
        echo "<td>" . $row['details'] . "</td>";
        echo "<td>
              <a href='update_vin.php?id=" . $row['vehicle_id'] . "'><button type='button' class='btn btn-primary'>Edit</button></a>
              <a href='delete_vin.php?id=" . $row['id'] . "'<button type='button' class='btn btn-danger'>Delete</button></a>
              </td>";
        echo "</tr>";
    }

    // End table
    echo "</table>";
}
?>
</table>
<br>
<a href="add_vin.php"><button type='button' class='btn btn-success'> Add New Vin </button></a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>