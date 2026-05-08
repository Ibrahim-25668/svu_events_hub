<?php
include "../db.php";

if (isset($_POST['update'])) {

    $id = $_GET['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {

        $image = "event_" . $id . ".jpg";
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = "../assets/img/" . $image;

        move_uploaded_file($tmp_name, $folder);

        mysqli_query($conn, "UPDATE events 
            SET title='$title', category='$category', event_date='$event_date',
                location='$location', image='$image', description='$description'
            WHERE id=$id");

    } else {

        mysqli_query($conn, "UPDATE events 
            SET title='$title', category='$category', event_date='$event_date',
                location='$location', description='$description'
            WHERE id=$id");
    }

    header("Location: dashboard.php");
    exit;
}


$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$event = mysqli_fetch_assoc($query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Event</title>

</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center mt-5">
        <div class="text-center border p-5 bg-light rounded">
            <h1>Edit Event</h1>

            <form action="edit_event.php?id=<?= $id ?>" method="post" enctype="multipart/form-data"
                class="form-group d-flex flex-column gap-3 mt-4">

                <input type="text" name="title" placeholder="Event Title" id="" value="<?php echo $event['title'] ?>"
                    class="form-control" required>
                <input type="date" name="event_date" placeholder="Event Date" id=""
                    value="<?php echo $event['event_date'] ?>" class="form-control" required>

                <select name="category" id="" class="form-control" required>
                    <option value="" selected disabled>Category</option>
                    <option value="Family" <?= $event['category'] == 'Family' ? 'selected' : '' ?>>Family</option>
                    <option value="Sports" <?= $event['category'] == 'Sports' ? 'selected' : '' ?>>Sports</option>
                    <option value="Culture" <?= $event['category'] == 'Culture' ? 'selected' : '' ?>>Culture</option>
                    <option value="Art" <?= $event['category'] == 'Art' ? 'selected' : '' ?>>Art</option>
                </select>

                <select name="location" id="" class="form-control" required>
                    <option value="" selected disabled>Location</option>
                    <option value="Damascus" <?= $event['location'] == 'Damascus' ? 'selected' : '' ?>>Damascus</option>
                    <option value="Latakia" <?= $event['location'] == 'Latakia' ? 'selected' : '' ?>>Latakia</option>
                    <option value="Aleppo" <?= $event['location'] == 'Aleppo' ? 'selected' : '' ?>>Aleppo</option>
                    <option value="Dir AlZor" <?= $event['location'] == 'Dir AlZor' ? 'selected' : '' ?>>Dir AlZor</option>
                    <option value="Homs" <?= $event['location'] == 'Homs' ? 'selected' : '' ?>>Homs</option>
                    <option value="Hama" <?= $event['location'] == 'Hama' ? 'selected' : '' ?>>Hama</option>
                    <option value="Darra" <?= $event['location'] == 'Darra' ? 'selected' : '' ?>>Darra</option>
                    <option value="Al Suida" <?= $event['location'] == 'Al Suida' ? 'selected' : '' ?>>Al suida</option>
                    <option value="Tartus" <?= $event['location'] == 'Tartus' ? 'selected' : '' ?>>Tartus</option>
                    <option value="Al Hasaka" <?= $event['location'] == 'Al Hasaka' ? 'selected' : '' ?>>Al Hasaka</option>
                    <option value="Al Raka" <?= $event['location'] == 'Al Raka' ? 'selected' : '' ?>>Al Raka</option>
                    <option value="Edleb" <?= $event['location'] == 'Edleb' ? 'selected' : '' ?>>Edleb</option>
                </select>


                <div class="border p-3">
                    <label for="image">Selected Image: <?= $event['image'] ?></label>
                    <input type="file" name="image" accept="image/*" id="image" class="form-control">
                </div>


                <textarea name="description" id="" placeholder="Event Description"
                    class="form-control"><?php echo $event['description'] ?></textarea>

                <div class="btn-box d-flex justify-content-between">
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <a href="dashboard.php" class="btn btn-outline-danger"
                        onclick="return confirm('Are You Sure?')">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>