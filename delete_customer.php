<?php
include('../config/konfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_customers_to_delete = $_GET['id'];

    // Delete the user based on the provided ID
    $delete_query = "DELETE FROM cutomers WHERE id_customers = '$id_customers_to_delete'";

    if (mysqli_query($conn, $delete_query)) {

        session_start();
        $_SESSION['success_message'] = "User successfully deleted.";

        header("Location: tampilan_customer.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
        exit();
    }
}

mysqli_close($conn);
?>
