<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_model_to_edit = $_GET['id'];

    // Fetch the user details based on the provided ID
    $query = "SELECT * FROM model WHERE id = '$id_model_to_edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $model_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }

    // Query untuk mendapatkan nilai dropdown dari tabel make
$query_dropdown_make = "SELECT id, make_name FROM make";
$result_dropdown_make = mysqli_query($conn, $query_dropdown_make);

$query_dropdown_type = "SELECT Id, type_name FROM vehicle_type";
$result_dropdown_type = mysqli_query($conn, $query_dropdown_type);

// Reset pointer hasil query
mysqli_data_seek($result_dropdown_make, 0);
mysqli_data_seek($result_dropdown_type, 0);

$selected_make = isset($_POST['make_id']) ? $_POST['make_id'] : '';
$selected_vehicle_type = isset($_POST['type_id']) ? $_POST['type_id'] : '';

// Fetch hasil query ke dalam array
$dropdown_make = [];
while ($row = mysqli_fetch_assoc($result_dropdown_make)) {
    $dropdown_make[$row['id']] = $row['make_name'];
}

$dropdown_type = [];
while ($row = mysqli_fetch_assoc($result_dropdown_type)) {
    $dropdown_type[$row['Id']] = $row['type_name'];
}
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the form submission for updating user details
    $id_model = $_POST['id'];
    $model_name = $_POST['model_name'];
    $make_id = $_POST['make_id'];
    $type_id = $_POST['type_id'];

    // Update user details
    $update_query = "UPDATE model 
                     SET model_name = '$model_name',
                     make_id = '$make_id',
                     vehicle_type_id = '$type_id'
                     WHERE id = '$id_model'";

    if (mysqli_query($conn, $update_query)) {
        session_start();
        $_SESSION['success_message'] = "User successfully updated.";

        header("Location: tampilan_model.php");
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
    <title>Edit Model</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>  
<div class="container mt-5">    
    <h2>Edit Model</h2>
    <br>
    <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $model_details['id']; ?>">

    <div class="row">
            <div class="col-md-10">
                    <div class="mb-8">        
                        <!-- Your form fields with current model details filled in -->
                        <label for="model_name"  class="form-label">Model Name:</label>
                        <input type="text" name="model_name" class="form-control" value="<?php echo $model_details['model_name']; ?>" required>
                    </div>
                    <div class="mb-8">    
                        <label for="make_name"  class="form-label">Make Name:</label>
                        <select name="make_id" class="form-control" required>
                        <?php
                        // Tampilkan opsi dropdown dari tabel_dropdown
                        foreach ($dropdown_make as $id_make => $make_name) {
                            $selected = ($id_make == $model_details['make_id']) ? 'selected' : '';
                            echo "<option value='$id_make' $selected>$make_name</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="mb-8">    
                        <label for="model_name" class="form-label">Type Name:</label>
                        <select name="type_id" class="form-control" required>
                            <?php
                            // Tampilkan opsi dropdown dari tabel_dropdown
                            foreach ($dropdown_type as $id_type => $type_name) {
                                $selected = ($id_type == $model_details['type_id']) ? 'selected' : '';
                                echo "<option value='$id_type' $selected>$type_name</option>";
                            }
                            ?>
                        </select>
                    </div>
            </div>
    </div>            
        <br>
        <input type="submit" value="Update Model" class="btn btn-primary">
    </form>
    <br>
    <a href="tampilan_model.php"><button type='button' class='btn btn-success'> Back to User List </button></a>
</div>
</body>
</html>
