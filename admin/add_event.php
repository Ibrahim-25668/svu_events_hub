<?php

include "../db.php";

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    $image = "event_" . uniqid() . ".jpg";
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "../assets/img/" . $image;
    move_uploaded_file($tmp_name, $folder);

    $description = $_POST['description'];

    $sql = "INSERT INTO events (title, category, event_date, location, image, description) VALUES ('$title', '$category', '$event_date', '$location', '$image', '$description')";

    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
    exit;
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
    <title>Add Event</title>

</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center mt-5">
        <div class="text-center bg-light p-5 rounded">
            <h1>Add Events</h1>

            <form action="add_event.php" method="post" enctype="multipart/form-data" class="form-group d-flex flex-column gap-3 mt-4">

                <input type="text" name="title" placeholder="Event Title" id="" class="form-control" required>

                <input type="date" name="event_date" placeholder="Event Date" id="" class="form-control" required>

                <select name="category" id="" class="form-control" required>
                    <option value="" selected disabled>Category</option>
                    <option value="Family">Family</option>
                    <option value="Sports">Sports</option>
                    <option value="Culture">Culture</option>
                    <option value="Art">Art</option>
                </select>

                <select name="location" id="" class="form-control" required>
                    <option value="" selected disabled>Location</option>
                    <option value="Damascus">Damascus</option>
                    <option value="Latakia">Latakia</option>
                    <option value="Aleppo">Aleppo</option>
                    <option value="Dir Alzor">Dir AlZor</option>
                    <option value="Homs">Homs</option>
                    <option value="Hama">Hama</option>
                    <option value="Darra">Darra</option>
                    <option value="Al Suida">Al suida</option>
                    <option value="Tartus">Tartus</option>
                    <option value="Al Hasaka">Al Hasaka</option>
                    <option value="Al Raka">Al Raka</option>
                    <option value="Edleb">Edleb</option>
                </select>

                <div class="border p-3">
                    <label for="image">Select Image: </label>
                    <input type="file" name="image" accept="image/*" id="image" class="form-control">
                </div>

                <textarea name="description" id="" placeholder="Event Description" class="form-control text-"></textarea>

                <div class="btn-box d-flex justify-content-between">
                    <button type="submit" class="btn btn-success" name="add">Add Event</button>
                    <a href="dashboard.php" class="btn btn-outline-danger"
                        onclick="return confirm('Are You Sure?')">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>