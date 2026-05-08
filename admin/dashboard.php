<?php
include "../db.php";

$query = mysqli_query($conn, "SELECT * FROM events");

session_start();
if (!isset($_SESSION["username"]) || ($_SESSION["role"] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>

    <style>
        body {
            background-color: white !important;
        }
    </style>

</head>

<body>

    <div class="container-fluid mt-5">

    <h1 class="text-center mb-5">Welcome, <span class="text-primary"><?php echo $_SESSION['username']; ?></span></h1>

        <h2 class="text-center mb-5">Events List</h2>

        <div class="btn-box d-flex justify-content-between">
            <a href="add_event.php" class="btn btn-success">Add Event</a>
            <a href="logout.php" class="btn btn-primary">Log out</a>

        </div>
        <div class="table-responsive">
            <table class="table mt-5">
                <tr>
                    <th> ID </th>
                    <th> Title </th>
                    <th> Category </th>
                    <th> Date </th>
                    <th> Location </th>
                    <th> Image </th>
                    <th> Description </th>
                    <th> Actions </th>
                </tr>


                <?php

                $no = 1;
                while ($events = mysqli_fetch_assoc($query)): ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $events['title']; ?></td>
                        <td><?php echo $events['category']; ?></td>
                        <td><?php echo $events['event_date']; ?></td>
                        <td><?php echo $events['location']; ?></td>
                        <td class="text-center"><img src="../assets/img/<?= $events['image'] ?>" width="100"></td>
                        <td><?php echo $events['description']; ?></td>
                        <td class="text-center">
                            <a href="edit_event.php?id=<?php echo $events['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_event.php?id=<?php echo $events['id']; ?>" class="btn btn-danger mt-1 ms-3"
                                onclick="return confirm('Are You Sure You Want To Delete This Event?')">Delete</a>
                        </td>
                    </tr>

                <?php endwhile; ?>

            </table>
        </div>
    </div>

</body>

</html>