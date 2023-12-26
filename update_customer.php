<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_customers_to_edit = $_GET['id'];

    // Fetch the user details based on the provided ID
    $query = "SELECT * FROM cutomers WHERE id_customers = '$id_customers_to_edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the form submission for updating user details
    $id_customers = $_POST['id_customers'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $company_name = $_POST['company_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $details = $_POST['details'];

    // Update user details
    $update_query = "UPDATE cutomers 
                     SET first_name = '$first_name', 
                         last_name = '$last_name', 
                         company_name = '$company_name', 
                         mobile = '$mobile', 
                         email = '$email', 
                         details = '$details' 
                     WHERE id_customers = '$id_customers'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: tampilan_customer.php");
        exit();
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <form action="" method="post">
    <input type="hidden" name="id_customers" value="<?php echo $user_details['id_customers']; ?>">

    <div class="row">
                <!-- Bagian Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $user_details['first_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label" >Last Name:</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $user_details['last_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name:</label>
                        <input type="text" name="company_name" class="form-control" value="<?php echo $user_details['company_name']; ?>" required>
                    </div>
                </div>
                <!-- Bagian Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile :</label>
                        <input type="text" name="mobile" class="form-control" value="<?php echo $user_details['mobile']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $user_details['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details :</label>
                        <input type="text" name="details" class="form-control" value="<?php echo $user_details['details']; ?>" required>
                    </div>
                </div>
    </div>
        <input type="submit" value="Update User" class="btn btn-primary">
    </form>
    <br>
    <a href="tampilan_customer.php"><button type='button' class='btn btn-success'> Back to User List </button></a>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
</html>
