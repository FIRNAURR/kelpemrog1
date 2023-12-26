<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Vehicle Service </title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
<body>
<div class="container mt-5">
<h2>Customers Profile</h2>
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
$result = mysqli_query($conn, "SELECT * FROM cutomers");

if (mysqli_num_rows($result) == 0) {
    echo "No data entry!";
    echo "<br>";
} else {
    // Start table
    echo "<br>";
    echo "<table class='table'>";
    
    // Output table headers
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>ID</th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Company Name</th>";
    echo "<th scope='col'>Mobile</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Details</th>";
    // echo "<th scope='col'>Insert Timestamp</th>";
    echo "<th scope='col'>Action</th>";
    echo "</tr>";
    echo "</thead>";

    // Output data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $row['id_customers'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['company_name'] . "</td>";
        echo "<td>" . $row['mobile'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['details'] . "</td>";
        // echo "<td>" . $row['insert_ts'] . "</td>";
        echo "<td>
              <a href='update_customer.php?id=" . $row['id_customers'] . "'><button type='button' class='btn btn-primary'>Edit</button></a>
              <a href='delete_customer.php?id=" . $row['id_customers'] . "'><button type='button' class='btn btn-danger'>Delete</button></a>
              </td>";
        echo "</tr>";
        echo "</tbody>";

    }

    // End table
    echo "</table>";

}
?>
<br>
<a href="add_customer.php"><button type='button' class='btn btn-success'>Add New Customers</button></a>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>