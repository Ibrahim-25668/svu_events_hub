<?php 

    $conn = mysqli_connect("sql311.infinityfree.com", "if0_41781840", "svueventshub", "if0_41781840_city_events","3306");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>
