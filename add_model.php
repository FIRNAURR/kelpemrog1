<?php
include('../config/konfig.php');

// Query untuk mendapatkan nilai dropdown dari tabel_dropdown
$query_dropdown_make = "SELECT id, make_name FROM make";
$result_dropdown_make = mysqli_query($conn, $query_dropdown_make);

$query_dropdown_type = "SELECT Id, type_name FROM vehicle_type";
$result_dropdown_type = mysqli_query($conn, $query_dropdown_type);

// Fetch hasil query ke dalam array
$dropdown_make = [];
while ($row = mysqli_fetch_assoc($result_dropdown_make)) {
    $dropdown_make[$row['id']] = $row['make_name'];
}

$dropdown_type = [];
while ($row = mysqli_fetch_assoc($result_dropdown_type)) {
    $dropdown_type[$row['Id']] = $row['type_name'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_model = $_POST['id'];
    $model_name = $_POST['model_name'];
    $make_id = $_POST['make_id'];
    $type_id = $_POST['type_id'];

    $sql = "INSERT INTO model (id, model_name, make_id, vehicle_type_id) 
            VALUES ('$id_model', '$model_name', '$make_id', '$type_id')";

    if (mysqli_query($conn, $sql)) {
        header("Location: tampilan_model.php");
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
    <title>Add Model</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Model</h2>
        <form action="" method="post">
            <div class="row">
                 <!-- Bagian Kiri -->
                 <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_model"  class="form-label">id model:</label>
                        <input type="text" class="form-control" name="id" placeholder="......." required>
                    </div>
                    <div class="mb-3">
                        <label for="model_name"  class="form-label">make name:</label>
                        <select name="make_id" class="form-control" placeholder="Select" required>
                            <?php
                            // Tampilkan opsi dropdown dari tabel_dropdown
                            foreach ($dropdown_make as $id_make => $make_name) {
                                echo "<option value='$id_make'>$make_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                 <!-- Bagian Kanan -->
                 <div class="col-md-6">
                    <div class="mb-3">    
                        <label for="model_name"  class="form-label">model name:</label>
                        <input type="text" class="form-control"  name="model_name" placeholder="......." required>
                    </div>
                    <div class="mb-3">    
                        <label for="model_name"  class="form-label">type name:</label>
                        <select name="type_id" class="form-control" placeholder="Select" required>
                            <?php
                            // Tampilkan opsi dropdown dari tabel_dropdown
                            foreach ($dropdown_type as $id_type => $type_name) {
                                echo "<option value='$id_type'>$type_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

        <input type="submit" value="Add Model" class="btn btn-primary">
    </form>
    <br>
    <a href="tampilan_model.php" ><button type='button' class='btn btn-success'>Back to Models List</button></a>
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</html>
