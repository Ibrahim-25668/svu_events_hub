<?php
include 'db.php';

$sql = "SELECT * FROM events WHERE 1";

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " AND title LIKE '%$search%'";
}

if (!empty($_GET['date'])) {
    $date = $_GET['date'];
    $sql .= " AND event_date = '$date'";
}

if (!empty($_GET['location'])) {
    $location = mysqli_real_escape_string($conn, $_GET['location']);
    $sql .= " AND location = '$location'";
}

if (!empty($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $sql .= " AND category = '$category'";
}

$query = mysqli_query($conn, $sql);

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>SVU Events Hub</title>

    <style>
    </style>

</head>

<body class="d-flex flex-column min-vh-100">

    <!-- header start -->

    <header class="mb-3">

        <!-- nav start -->
        <nav class="navbar navbar-expand-lg navbar-dark">

            <div class="container-fluid">

                <a class="navbar-brand" href="index.php"><span class="text-warning"
                        style="font-weight: bold;">S</span><span class="text-primary"
                        style="font-weight: bold;">VU</span> Events Hub <img src="assets/img/logo.png" class="img-fluid"
                        style="border-radius: 45%; width: 40px; height: 40px;" alt="SVU Events Hub Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    
                    <ul class="navbar-nav ms-auto mb-2">
                        <li class="nav-item">
                            <a class="nav-link active mx-2" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mx-2" aria-current="page" href="events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mx-2" aria-current="page" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mx-2" aria-current="page" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            session_start();
                            if (isset($_SESSION['username']) && $_SESSION['role'] === 'user') {
                                echo '<a class="nav-link active mx-2" aria-current="page" href="admin/logout.php">Logout</a>';
                            } else {
                                echo '<a class="nav-link active mx-2" aria-current="page" href="admin/login.php">Login</a>';
                            }
                            ?>
                        </li>
                    </ul>

                    <!-- Dark Mode Toggle -->
                    <div class="form-check form-switch text-white">
                        <input class="form-check-input" type="checkbox" id="themeToggle">
                        <label class="form-check-label" for="themeToggle">☀️</label>
                    </div>
                </div>

            </div>

        </nav>
        <!-- nav end -->

    </header>

    <!-- header end -->


    <!-- Filter Section  -->

    <div class="filter mb-2 m-auto d-flex justify-content-center align-items-center row">

        <button class="btn mb-3" style="background-color:#093426; color: #E7F3EF; width: 60%" data-bs-toggle="collapse"
            data-bs-target="#filterBox">
            Filter
        </button>

        <form method="GET">

            <input class="form-control rounded-pill mb-3" type="search" name="search" placeholder="Search Events..."
                value="<?= $_GET['search'] ?? '' ?>">

            <div class="collapse" id="filterBox">

                <input type="date" name="date" class="form-control my-3" value="<?= $_GET['date'] ?? '' ?>">

                <select name="location" id="" class="form-control my-3">
                    <option value="" selected disabled>Location</option>
                    <option value="">All</option>
                    <option value="Damascus" <?= (($_GET['location'] ?? '') == 'Damascus') ? 'selected' : '' ?>>Damascus
                    </option>
                    <option value="Latakia" <?= (($_GET['location'] ?? '') == 'Latakia') ? 'selected' : '' ?>>Latakia
                    </option>
                    <option value="Aleppo" <?= (($_GET['location'] ?? '') == 'Aleppo') ? 'selected' : '' ?>>Aleppo</option>
                    <option value="Dir Alzor" <?= (($_GET['location'] ?? '') == 'Dir Alzor') ? 'selected' : '' ?>>Dir AlZor
                    </option>
                    <option value="Homs" <?= (($_GET['location'] ?? '') == 'Homs') ? 'selected' : '' ?>>Homs</option>
                    <option value="Hama" <?= (($_GET['location'] ?? '') == 'Hama') ? 'selected' : '' ?>>Hama</option>
                    <option value="Darra" <?= (($_GET['location'] ?? '') == 'Darra') ? 'selected' : '' ?>>Darra</option>
                    <option value="Al Suida" <?= (($_GET['location'] ?? '') == 'Al Suida') ? 'selected' : '' ?>>Al suida
                    </option>
                    <option value="Tartus" <?= (($_GET['location'] ?? '') == 'Tartus') ? 'selected' : '' ?>>Tartus</option>
                    <option value="Al Hasaka" <?= (($_GET['location'] ?? '') == 'Al Hasaka') ? 'selected' : '' ?>>Al Hasaka
                    </option>
                    <option value="Al Raka" <?= (($_GET['location'] ?? '') == 'Al Raka') ? 'selected' : '' ?>>Al Raka
                    </option>
                    <option value="Edleb" <?= (($_GET['location'] ?? '') == 'Edleb') ? 'selected' : '' ?>>Edleb</option>
                </select>

                <select name="category" id="" class="form-control my-3">
                    <option value="" selected disabled>Category</option>
                    <option value="">All</option>
                    <option value="Family" <?= (($_GET['category'] ?? '') == 'Family') ? 'selected' : '' ?>>Family</option>
                    <option value="Sports" <?= (($_GET['category'] ?? '') == 'Sports') ? 'selected' : '' ?>>Sports</option>
                    <option value="Culture" <?= (($_GET['category'] ?? '') == 'Culture') ? 'selected' : '' ?>>Culture
                    </option>
                    <option value="Art" <?= (($_GET['category'] ?? '') == 'Art') ? 'selected' : '' ?>>Art</option>
                </select>

                <div class="btn-box d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Filter</button>

                    <a href="events.php" class="btn btn-danger">Clear</a>
                </div>

            </div>

        </form>

    </div>



    <!-- main start -->

    <main class="container-fluid flex-grow-1">

        <?php
        $result_count = mysqli_num_rows($query);
        $count = 0;
        ?>

        <?php if ($result_count == 0): ?>

            <div class="alert alert-warning text-center mt-5"> No results found </div>

        <?php else: ?>

            <section class="gap-4 slid d-flex overflow-auto mt-5">

                <?php while ($events = mysqli_fetch_assoc($query)): ?>

                    <?php

                    if ($count > 0 && $count % 4 == 0) {
                        echo '</section>';
                        echo '<section class="gap-4 slid d-flex overflow-auto mt-5">';
                    }
                    ?>

                    <div class="card flex-shrink-0 shadow card-item mb-2" style="width: 18rem;">
                        <img src="assets/img/<?php echo $events['image']; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $events['title']; ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo $events['event_date']; ?></li>
                            <li class="list-group-item"><?php echo $events['location']; ?></li>
                            <li class="list-group-item"><?php echo $events['category']; ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="event.php?id=<?php echo $events['id']; ?>" class="btn btn-primary">learn more</a>
                        </div>
                    </div>

                    <?php $count++; ?>

                <?php endwhile; ?>

            </section>

        <?php endif; ?>

    </main>

    <!-- main end -->

    <!-- footer start -->

    <footer class="footer bd-footer py-5 mt-5">
        <div class="container">
            <div class="row text-center">

                <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                    <h4 class="text-white mb-2"><span class="text-warning">S</span><span class="text-primary">VU</span>
                        Events Hub</h4>

                    <p class="text-white">It's is a platform that helps students find events quickly and easily.</p>
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['role'] === 'user') {
                        echo '<a class=" aria-current="page" href="admin/logout.php" style="text-decoration: none;">Logout</a>';
                    } else {
                        echo '<a class="" aria-current="page" href="admin/login.php" style="text-decoration: none;">Login Now</a>';
                    }
                    ?>
                </div>

                <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                    <h5 class="text-white mb-3">Contact :</h5>
                    <p class="text-light mb-1 me-2"><i class="fa-solid fa-phone me-3"></i>(+963) 933 333 333</p>
                    <p class="text-light mb-1 me-2"><i class="fa-solid fa-phone me-3"></i>011 4444</p>
                    <p class="text-light"><i class="fas fa-envelope"></i> info@svu-events.com</p>
                </div>

                <div class="col-6 col-lg-2 offset-lg-1 mb-3 mar-footer">
                    <h5 class="text-white mb-3">Follow Us :</h5>

                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <div class="col-6 col-lg-2 offset-lg-1 mb-3 mar-footer">
                    <h5 class="text-white mb-3">Links :</h5>

                    <a href="index.php" class="" style="text-decoration: none; display: block;">Home</a>
                    <a href="events.php" class="" style="text-decoration: none; display: block;">Events</a>
                    <a href="about.php" class="" style="text-decoration: none; display: block;">About</a>
                    <a href="contact.php" class="" style="text-decoration: none; display: block;">Contact</a>
                </div>

            </div>

            <hr class="bg-light">

            <div class="text-center text-light">
                Copyright &copy; 2026 SVU Events Hub
            </div>
        </div>

    </footer>

    <!-- footer end -->

    <!-- Scroll to top button -->

    <button id="scrollToTopBtn" class="btn btn-success position-fixed bottom-0 end-0 m-4" style="display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

    <script></script>

</body>

</html>