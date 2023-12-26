<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_vin_to_edit = $_GET['id'];

    // Fetch the user details based on the provided ID
    $query = "SELECT * FROM vin WHERE vehicle_id = '$id_vin_to_edit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $vin_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit();
    }

    $query_dropdown_cs = "SELECT id_customers, first_name FROM cutomers";
    $result_dropdown_cs = mysqli_query($conn, $query_dropdown_cs);
    
    $query_dropdown_model = "SELECT id, model_name FROM model";
    $result_dropdown_model = mysqli_query($conn, $query_dropdown_model);

// Reset pointer hasil query
mysqli_data_seek($result_dropdown_cs, 0);
mysqli_data_seek($result_dropdown_model, 0);

$selected_cs = isset($_POST['customers_id']) ? $_POST['customers_id'] : '';
$selected_model = isset($_POST['model_id']) ? $_POST['model_id'] : '';

// Fetch hasil query ke dalam array
$dropdown_cs = [];
while ($row = mysqli_fetch_assoc($result_dropdown_cs)) {
    $dropdown_cs[$row['id_customers']] = $row['first_name'];
}

$dropdown_model = [];
while ($row = mysqli_fetch_assoc($result_dropdown_model)) {
    $dropdown_model[$row['id']] = $row['model_name'];
}
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the form submission for updating user details
    $vehicle_id = $_POST['vehicle_id'];
    $vin = $_POST['vin'];
    $license_plate = $_POST['license_plate'];
    $customers_id = $_POST['customers_id'];
    $model_id = $_POST['model_id'];
    $manufactured_year = $_POST['manufactured_year'];
    $manufactured_month = $_POST['manufactured_month'];
    $details = $_POST['details'];

    // Update user details
    $update_query = "UPDATE vin 
                     SET vin = '$vin',
                     license_plate = '$license_plate',
                     customers_id = '$customers_id',
                     model_id = '$model_id',
                     manufactured_year = '$manufactured_year',
                     manufactured_month = '$manufactured_month',
                     details = '$details'
                     WHERE vehicle_id = '$vehicle_id'";

    if (mysqli_query($conn, $update_query)) {
        session_start();
        $_SESSION['success_message'] = "User successfully updated.";

        header("Location: tampilan_vin.php");
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
    <title>Edit VIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Edit VIN</h2>
    <form action="" method="post">
        <input type="hidden" name="vehicle_id" value="<?php echo $vin_details['vehicle_id']; ?>">
        <div class="row">
                        <!-- Bagian Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="vehicle_id"  class="form-label">Id vehicle:</label>
                                <input type="text" class="form-control" name="vehicle_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="vin"  class="form-label">VIN:</label>
                                <input type="text" class="form-control" name="vin" required>
                             </div>
                             <div class="mb-3">
                                <label for="license_plate"  class="form-label">License plate:</label>
                                <input type="text" class="form-control" name="license_plate" required>
                            </div>
                            <div class="mb-3">
                                <label for="customers_id"  class="form-label">Make name:</label>
                                <select name="customers_id" class="form-control" required>
                                    <?php
                                    // Tampilkan opsi dropdown dari tabel_dropdown
                                    foreach ($dropdown_cs as $id_cs => $cs_name) {
                                        echo "<option value='$id_cs'>$cs_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Bagian Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="model_id"  class="form-label">Model name:</label>
                                <select name="model_id" class="form-control" required>
                                    <?php
                                    // Tampilkan opsi dropdown dari tabel_dropdown
                                    foreach ($dropdown_model as $id_model => $model_name) {
                                        echo "<option value='$id_model'>$model_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="manufactured_year"  class="form-label">Manufactured year:</label>
                                <input type="text" class="form-control" name="manufactured_year" required>
                            </div>
                            <div class="mb-3">
                                <label for="manufactured_month"  class="form-label">Manufactured month:</label>
                                <input type="text" class="form-control" name="manufactured_month" required>
                            </div>
                            <div class="mb-3">
                                <label for="details"  class="form-label">Details:</label>
                                <input type="text" class="form-control" name="details" required>
                            </div>
                        </div>
            </div>
        <input type="submit" value="Update Model" class="btn btn-primary">
    </form>
    <br>
    <a href="tampilan_vin.php"><button type='button' class='btn btn-success'>Back to VIN List</button></a>
</body>
</html>
