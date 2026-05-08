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

    <!-- main start -->

    <main class="flex-grow-1">

        <div class="row justify-content-center w-100 mx-0 my-5">
            <div class="col-md-6 col-lg-4">

                <div class="card shadow p-4">
                    <h2 class="text-center mb-4 font-sty" style="font-style: normal; text-decoration: none;">Contact Us
                    </h2>

                    <form id="contactForm" novalidate>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" required>
                            <div class="invalid-feedback">Please enter your name</div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                            <div class="invalid-feedback">Enter a valid email</div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" required>
                            <div class="invalid-feedback">Enter a valid phone number</div>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="1" required></textarea>
                            <div class="invalid-feedback">Message cannot be empty</div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Send Message</button>

                    </form>

                    <!-- Success Message -->
                    <div id="successMsg" class="alert alert-success mt-3 d-none">
                        Message sent successfully <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>
        </div>

        <div class="row justify-content-center w-100 mx-0 my-5">
            <div class="col-md-6 col-lg-4">
                <table class="table table-success border shadow">

                <thead>
                    <tr>
                        <th colspan="2" class="text-center fw-bold fs-5 font-sty">Contact Information</th>
                    </tr>
                </thead>

                    <tr>
                        <th> <i class="fa-solid fa-phone"></i> Phone:</th>
                        <td>(+963) 933 333 333</td>
                    </tr>

                    <tr>
                        <th> <i class="fas fa-envelope"></i> Email:</th>
                        <td>svueventshub@edu.sy</td>
                    </tr>

                    <tr>
                        <th> <i class="fas fa-map-marker-alt"></i> Address:</th>
                        <td>Syrian Virtual University, Damascus, Syria</td>
                    </tr>

                    <tr>
                        <th> <i class="fab fa-facebook-f"></i> Facebook:</th>
                        <td><a href="https://www.facebook.com" target="_blank">facebook.com/svu.edu.sy</a>
                        </td>
                    </tr>

                    <tr>
                        <th> <i class="fab fa-instagram"></i> Instagram:</th>
                        <td><a href="https://www.instagram.com" target="_blank">instagram.com/svu.edu.sy</a>
                        </td>
                    </tr>

                    <tr>
                        <th> <i class="fab fa-telegram"></i> Telegram:</th>
                        <td><a href="https://t.me/svu_edu_sy" target="_blank">t.me/svu_edu_sy</a></td>
                    </tr>


                </table>
            </div>
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

    <script></script>

</body>

</html>