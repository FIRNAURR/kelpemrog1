<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_make_to_edit = $_GET['id'];

    // Fetch the user details based on the provided ID
    $query = "SELECT * FROM make WHERE id = '$id_make_to_edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $make_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the form submission for updating user details
    $id_make = $_POST['id'];
    $make_name = $_POST['make_name'];

    // Update user details
    $update_query = "UPDATE make 
                     SET make_name = '$make_name' 
                     WHERE id = '$id_make'";

    if (mysqli_query($conn, $update_query)) {
        session_start();
        $_SESSION['success_message'] = "User successfully updated.";

        header("Location: tampilan_make.php");
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
    <title>Edit Make</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">    
    <h2>Edit Make</h2>
    <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $make_details['id']; ?>">

    <div class="row">
                <div class="col-md-10">
                    <div class="mb-7">
                        <!-- Your form fields with current make details filled in -->
                        <label for="make_name" class="form-label">Make Name:</label>
                        <input type="text" name="make_name" class="form-control" value="<?php echo $make_details['make_name']; ?>" required>
                    </div>
                </div>
    </div>
                        <br>
                <input type="submit" value="Update Make" class="btn btn-primary">
            </form>
            <br>
    <a href="tampilan_make.php"><button type='button' class='btn btn-success'>Back to Make List </button></a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
