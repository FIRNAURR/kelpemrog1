<?php
include('../config/konfig.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_customers = $_POST['id_customers'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $company_name = $_POST['company_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $details = $_POST['details'];

    $sql = "INSERT INTO cutomers (id_customers, first_name, last_name, company_name, mobile, email, details, insert_ts) 
            VALUES ('$id_customers', '$first_name', '$last_name', '$company_name', '$mobile', '$email', '$details', NOW())";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['success_message'] = "User successfully Added.";
        header("Location: tampilan_customer.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New User</h2>
    <form action="" method="post">
            <div class="row">
                <!-- Bagian Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_customers" class="form-label">ID Customer :</label>
                        <input type="text" class="form-control" name="id_customers" placeholder="......." required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name :</label>
                        <input type="text" class="form-control" name="first_name" placeholder="......." required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name :</label>
                        <input type="text" class="form-control" name="last_name" placeholder="......." required>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name :</label>
                        <input type="text" class="form-control" name="company_name" placeholder="......." required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Phone Number :</label>
                        <input type="text" class="form-control" name="mobile" placeholder="......." required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email" placeholder="......." required>
                    </div>
                </div>
            </div>

            <!-- Bagian Bawah -->
            <div class="mb-3">
                <label for="details" class="form-label">Details:</label>
                <input type="text" class="form-control" name="details" placeholder="......." required>
            </div>

            <input type="submit" value="Add User" class="btn btn-primary">
        </form>
    <br>
    <a href="tampilan_customer.php"><button type='button' class='btn btn-success'>Back to User List</button></a>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
