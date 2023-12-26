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
<h2>Vehicle Info</h2>
<a href="../index.php"><button type="button" class="btn btn-outline-primary">Back to Main Menu</button></a>
<br>
 <?php
// Include database connection
include('../config/konfig.php');


session_start();
if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']); // Clear the session variable
}

// Fetch data from the database
$result = mysqli_query($conn, "SELECT * FROM vehicle_type");

if (mysqli_num_rows($result) == 0) {
    echo "Data empty";
} else {
    // Start table
    echo "<table class='table'>";
    
    // Output table headers
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Type Name</th>";
    echo "</tr>";

    // Output data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Id'] . "</td>";
        echo "<td>" . $row['type_name'] . "</td>";
        echo "<td>
              <a href='update_type.php?id=" . $row['Id'] . "'><button type='button' class='btn btn-primary'>Edit</button></a>
              <a href='delete_type.php?id=" . $row['Id'] . "'><button type='button' class='btn btn-danger'>Delete</button></a>
              </td>";
        echo "</tr>";
    }

    // End table
    echo "</table>";
}
?>
</table>
<br>
<a href="add_type.php"><button type='button' class='btn btn-success'> Add New Type </button></a>
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</html>