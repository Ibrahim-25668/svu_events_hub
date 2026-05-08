<?php
include "db.php";

$query = mysqli_query($conn, "SELECT * FROM events");


if (!isset($_GET['id'])) {
    echo "No event selected";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM events WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "Event not found";
    exit;
}

$category = $event['category'];
$related_sql = "SELECT * FROM events 
                WHERE category = '$category' 
                AND id != '$id'
                LIMIT 6";

$related_query = mysqli_query($conn, $related_sql);

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
        img {
            width: 500px;
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        .carousel {
            width: 90% !important;
            margin: 0 auto;
        }

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

    <!-- main start -->

    <main class="container-fluid">

        <!-- Info section  -->

        <h1 class="text-center my-4 fw-bold font-sty"><?php echo $event['title']; ?></h1>

        <div class="row align-items-center">

            <div class="info col-12 col-md-6 text-md-center text-md-start">

                <h3><span class="fw-bold fs-8 font-sty">Event Date: </span><?php echo $event['event_date']; ?></h3>

                <h3><span class="fw-bold fs-8 font-sty">Event Location: </span><?php echo $event['location']; ?></h3>

                <h3><span class="fw-bold fs-8 font-sty">Event Category: </span> <?php echo $event['category']; ?></h3>

                <h3 class="text-center mt-4"> <span class="fw-bold fs-8 font-sty">Description:</span></h3>
                <h5 class="text-center"> <?php echo $event['description']; ?>
                </h5>
            </div>

            <div class="image my-4 col-12 col-md-6 text-md-end">
                <img src="assets/img/<?php echo $event['image']; ?>" alt="" class="img-fluid">
            </div>

        </div>

        <hr class="bg-dark" style="height: 2px;">

        <!-- section 1 -->

        <div class="gallery my-5">

            <h2 class="text-center my-4 fw-bold fs-8 font-sty">Gallery: </h2>

            <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/<?php echo $event['image']; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/<?php echo $event['image']; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/<?php echo $event['image']; ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>

        <hr class="bg-dark" style="height: 2px;">

        <!-- section 2 -->
        <div class="section_2">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d106456.532283464!2d36.20049404028804!3d33.507448225242925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e6dc413cc6a7%3A0x6b9f66ebd1e394f2!2sDamascus%2C%20Syria!5e0!3m2!1sen!2s!4v1777676207516!5m2!1sen!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <div class="box-btn my-5 text-center">

                <!-- add to calendar -->
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Add to Calendar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                The event has been added to your calendar.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" data-bs-target="#exampleModalToggle2"
                                    data-bs-toggle="modal" data-bs-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add to
                    Calendar</a>

                <!-- btn share -->
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Share Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                The event has been shared successfully with your friends.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" data-bs-target="#exampleModalToggle2"
                                    data-bs-toggle="modal" data-bs-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-secondary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Share
                    Event</a>

                <!-- btn back to events -->
                <a href="events.php" class="btn btn-warning m-2">Back to Events</a>

            </div>

        </div>

        <hr class="bg-dark" style="height: 2px;">

        <!-- section 3 -->

        <div class="section_3 my-5">

            <h2 class="fw-bold fs-8 font-sty">Related Events: </h2>

            <section class="gap-4 slid d-flex overflow-auto">

                <?php if (mysqli_num_rows($related_query) > 0): ?>

                    <section class="gap-4 slid d-flex overflow-auto">

                        <?php while ($events = mysqli_fetch_assoc($related_query)): ?>

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
                                    <a href="event.php?id=<?php echo $events['id']; ?>" class="btn btn-primary">
                                        learn more
                                    </a>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </section>

                <?php else: ?>

                    <div class="alert alert-warning text-center mt-3">
                        No related events found
                    </div>

                <?php endif; ?>

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

    <script>


    </script>

</body>

</html>