<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_type_to_edit = $_GET['id'];

    // Fetch the user details based on the provided ID
    $query = "SELECT * FROM vehicle_type WHERE Id = '$id_type_to_edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $type_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the form submission for updating user details
    $id_type = $_POST['id'];
    $type_name = $_POST['type_name'];

    // Update user details
    $update_query = "UPDATE vehicle_type 
                     SET type_name = '$type_name' 
                     WHERE Id = '$id_type'";

    if (mysqli_query($conn, $update_query)) {
        session_start();
        $_SESSION['success_message'] = "User successfully updated.";

        header("Location: tampilan_type.php");
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
    <title>Edit Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">    
    <h2>Edit Type</h2>
    <br>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $type_details['Id']; ?>">
        
    <div class="row">
        <div class="col-md-12">
            <div class="mb-9">        
                <!-- Your form fields with current type details filled in -->
                <label for="type_name" class="form-label">Type Name:</label>
                <input type="text" class="form-control" name="type_name" value="<?php echo $type_details['type_name']; ?>" required>
            </div>
        </div>
    </div>    
<br>
            <input type="submit" value="Update Type" class="btn btn-primary">
            </form>
            <br>
    <a href="tampilan_type.php"><button type='button' class='btn btn-success'> Back to User List </button></a>
</div>
</body>
</html>
