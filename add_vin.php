<?php
include('../config/konfig.php');

// Query untuk mendapatkan nilai dropdown dari tabel_dropdown
$query_dropdown_cs = "SELECT id_customers, first_name FROM cutomers";
$result_dropdown_cs = mysqli_query($conn, $query_dropdown_cs);

$query_dropdown_model = "SELECT id, model_name FROM model";
$result_dropdown_model = mysqli_query($conn, $query_dropdown_model);

// Fetch hasil query ke dalam array
$dropdown_cs = [];
while ($row = mysqli_fetch_assoc($result_dropdown_cs)) {
    $dropdown_cs[$row['id_customers']] = $row['first_name'];
}

$dropdown_model = [];
while ($row = mysqli_fetch_assoc($result_dropdown_model)) {
    $dropdown_model[$row['id']] = $row['model_name'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_id = $_POST['vehicle_id'];
    $vin = $_POST['vin'];
    $license_plate = $_POST['license_plate'];
    $customers_id = $_POST['customers_id'];
    $model_id = $_POST['model_id'];
    $manufactured_year = $_POST['manufactured_year'];
    $manufactured_month = $_POST['manufactured_month'];
    $details = $_POST['details'];

    $sql = "INSERT INTO vin (vehicle_id, vin, license_plate, customers_id, model_id, manufactured_year, manufactured_month, details, insert_ts) 
            VALUES ('$vehicle_id', '$vin', '$license_plate', '$customers_id', '$model_id', '$manufactured_year', '$manufactured_month', '$details', NOW())";

    if (mysqli_query($conn, $sql)) {
        header("Location: tampilan_vin.php");
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
    <title>Add VIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New VIN</h2>
    <form action="" method="post">
            <div class="row">
                        <!-- Bagian Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="vehicle_id"  class="form-label">id vehicle:</label>
                                <input type="text" class="form-control" name="vehicle_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="vin"  class="form-label">VIN:</label>
                                <input type="text" class="form-control" name="vin" required>
                             </div>
                             <div class="mb-3">
                                <label for="license_plate"  class="form-label">license plate:</label>
                                <input type="text" class="form-control" name="license_plate" required>
                            </div>
                            <div class="mb-3">
                                <label for="customers_id"  class="form-label">make name:</label>
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
                                <label for="model_id"  class="form-label">model name:</label>
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
                                <label for="manufactured_year"  class="form-label">manufactured year:</label>
                                <input type="text" class="form-control" name="manufactured_year" required>
                            </div>
                            <div class="mb-3">
                                <label for="manufactured_month"  class="form-label">manufactured month:</label>
                                <input type="text" class="form-control" name="manufactured_month" required>
                            </div>
                            <div class="mb-3">
                                <label for="details"  class="form-label">details:</label>
                                <input type="text" class="form-control" name="details" required>
                            </div>
                        </div>
            </div>

                        
            <input type="submit" value="Add Vin" class="btn btn-primary">
    </form>
    <br>
    <a href="tampilan_vin.php"><button type='button' class='btn btn-success'>Back to Vin List</button></a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
