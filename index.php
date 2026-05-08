<?php
include "db.php";

$query_1 = mysqli_query($conn, "SELECT * FROM events");

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $query_2 = mysqli_query($conn, "SELECT * FROM events WHERE category='$category'");
} else {
    $query_2 = mysqli_query($conn, "SELECT * FROM events");
}

$query_3 = mysqli_query($conn, "SELECT * FROM events");
// session_start();

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

<body class="d-flex flex-column min-vh-100 overflow-x-hidden">

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

    <!-- IDs Here -->

    <div class="m-auto">

        <button class="btn" style="background-color:#093426; color: #E7F3EF;" data-bs-toggle="collapse"
            data-bs-target="#ids" aria-controls="ids" aria-expanded="false" aria-label="">Click Here To See IDs
        </button>

        <div class="collapse" id="ids">

                <p class="ids shadow mt-3">mohamad_195470</p>
                <p class="ids shadow mt-2">ahmad_286451</p>
                <p class="ids shadow mt-2">abdul_karem_302579</p>
                <p class="ids shadow mt-2">tasneem_233612</p>
                <p class="ids shadow mt-2">ibrahim_306308</p>
            

        </div>

    </div>

    <hr class="bg-dark" style="height: 2px;">

    <!-- header end -->

    <!-- main start -->

    <main class="container-fluid flex-grow-1">

        <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'user') {
            echo '<h1 class="text-center">Welcome <span
                class="text-primary"> ' . $_SESSION['username'] . ' </span>
            to Our Event Portal</h1>';
        }
        ?>

        <!-- section 1 -->

        <div class="section_1 mt-3">

            <h2 class=""><span class="text-danger" style="font-style: italic; font-family: serif;">New</span> Events:
            </h2>

            <section class="gap-4 slid d-flex overflow-auto">

                <?php $wanted = [1, 3, 5];

                $no = 1;
                while ($events = mysqli_fetch_assoc($query_1)) {

                    if (in_array($no, $wanted)) {
                        ?>

                        <div class="card flex-shrink-0 shadow card-item mb-2" style="width: 18rem;">
                            <img src="assets/img/<?php echo $events['image']; ?>" class="card-img-top" alt="...">
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

                        <?php
                    }

                    $no++;
                }
                ?>

            </section>

        </div>

        <hr class="bg-dark" style="height: 2px;">

        <!-- section 2 -->

        <div class="section_2 mt-4" id="section_2">

            <h2>Categories:</h2>

            <div class="btn-cate mb-3">
                <a href="index.php#section_2" class="btn btn-primary">All</a>
                <a href="?category=family#section_2" class="btn btn-info">Family</a>
                <a href="?category=culture#section_2" class="btn btn-warning">Culture</a>
                <a href="?category=art#section_2" class="btn btn-secondary">Art</a>
                <a href="?category=sports#section_2" class="btn btn-success">Sport</a>
            </div>

            <section class="gap-4 slid d-flex overflow-auto">

                <?php
                $count = 0;

                while ($events = mysqli_fetch_assoc($query_2)):

                    if ($count == 6)
                        break;
                    ?>

                    <div class="card flex-shrink-0 shadow card-item mb-2" style="width: 18rem;">
                        <img src="assets/img/<?php echo $events['image']; ?>" class="card-img-top" alt="...">
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

                    <?php
                    $count++;
                endwhile;
                ?>

            </section>

        </div>

        <hr class="bg-dark" style="height: 2px;">

        <!-- section 3 -->

        <div class="section_3 mt-4">

            <h2><span class="text-success">Highlights</span> Events this week:</h2>

            <section class="gap-4 slid d-flex overflow-auto">

                <?php $wanted = [2, 3, 6];

                $no = 1;
                while ($events = mysqli_fetch_assoc($query_3)) {

                    if (in_array($no, $wanted)) {
                        ?>

                        <div class="card flex-shrink-0 shadow card-item mb-2" style="width: 18rem;">
                            <img src="assets/img/<?php echo $events['image']; ?>" class="card-img-top" alt="...">
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

                        <?php
                    }

                    $no++;
                }
                ?>

            </section>

        </div>

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
                        echo '<a class="nav-link active mx-2" aria-current="page" href="admin/logout.php" style="text-decoration: none;">Logout</a>';
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

    <script>

    </script>

</body>

</html>