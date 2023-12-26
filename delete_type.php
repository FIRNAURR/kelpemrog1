<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_type_to_delete = $_GET['id'];

    // Delete the user based on the provided ID
    $delete_query = "DELETE FROM vehicle_type WHERE Id = '$id_type_to_delete'";

    if (mysqli_query($conn, $delete_query)) {

        session_start();
        $_SESSION['success_message'] = "User successfully deleted.";

        header("Location: tampilan_type.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
        exit();
    }
}

mysqli_close($conn);
?>
