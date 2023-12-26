<?php
include('../config/konfig.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_type = $_POST['id'];
    $type_name = $_POST['type_name'];

    $sql = "INSERT INTO vehicle_type (id, type_name) 
            VALUES ('$id_type', '$type_name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: tampilan_type.php");
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
    <title>Add Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New type</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-8">
                        <label for="id" class="form-label">id type:</label>
                        <input type="text" class="form-control" name="id" required>
                    </div>
                    <div class="mb-8">

                        <label for="type_name" class="form-label">type name:</label>
                        <input type="text" class="form-control" name="type_name" required>
                    </div>
                </div>
            </div> 
            <br>       
        <input type="submit" value="Add Type" class="btn btn-primary">
    </form>
    <br>               
    <a href="tampilan_type.php"><button type='button' class='btn btn-success'>Back to Models List</button></a>
</body>
</html>
