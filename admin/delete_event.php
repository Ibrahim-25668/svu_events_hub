<?php

include "../db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $event = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events WHERE id=$id"));
    $image_path = "../assets/img/" . $event['image'];

    if (file_exists($image_path)) {
        unlink($image_path);
    }

    mysqli_query($conn, "DELETE FROM events WHERE id=$id");

    header("Location: dashboard.php");

    header("Location: dashboard.php");
    exit;
}

?>