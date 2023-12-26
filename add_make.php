<?php
include('../config/konfig.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_make = $_POST['id'];
    $make_name = $_POST['make_name'];

    $sql = "INSERT INTO make (id, make_name) 
            VALUES ('$id_make', '$make_name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: tampilan_make.php");
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
    <title>Add Make</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Make</h2>
        <form action="" method="post">
                <div class="row">
                <!-- Bagian Tengah -->
                    <div class="col-md-10">
                        <div class="mb-8">
                            <label for="id_make" class="form-label">id make:</label>
                            <input type="text" class="form-control" name="id" required>
                        </div>
                        <div class="mb-8">
                            <label for="make_name" class="form-label">make name:</label>
                            <input type="text" class="form-control" name="make_name" placeholder="Example Indonesia" required required>
                        </div>
                    </div>
                </div>
            <br>
            <input type="submit" value="Add Make" class="btn btn-primary">
        </form>
    <br>
    <a href="tampilan_make.php" ><button type='button' class='btn btn-success'> Back to Make List</button></a>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
