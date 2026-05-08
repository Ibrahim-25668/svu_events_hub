<?php
session_start();

include("../db.php");

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $checkUser = $conn->query("SELECT username FROM users WHERE username='$username'");

    if ($checkUser->num_rows > 0) {
        $_SESSION['register_error'] = "Username already registered.";
        $_SESSION['active_form'] = 'registerForm';

    } else {
        $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    }

    header("Location: login.php");
    exit();
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['password'] === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            if ($_SESSION['role'] === 'admin') {
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        }
    }
    $_SESSION['login_error'] = "Invalid username or password.";
    $_SESSION['active_form'] = 'loginForm';
    header("Location: login.php");
    exit();
}

// session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'loginForm';

session_unset();

function showError($error)
{
    return !empty($error) ? "<div class='alert alert-danger'>$error</div>" : '';
}

function showForm($formId, $activeForm)
{
    return $formId === $activeForm ? '' : 'd-none';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard_style.css">

    <title>Login</title>
</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">


        <!-- Login Form -->

        <div class="text-center bg-light p-5 rounded shadow-lg <?php echo showForm('loginForm', $activeForm); ?>" id="loginForm">

            <h1>Login</h1>

            <?php echo showError($errors['login']); ?>

            <form action="login.php" method="post" enctype="multipart/form-data"
                class="form-group d-flex flex-column gap-3 mt-4">

                <input type="text" name="username" id="username" placeholder="Username" class="form-control mb-3 pe-5"
                    required>

                <input type="password" name="password" id="password" placeholder="Password"
                    class="form-control mb-3 pe-5" required>

                <button type="submit" class="btn btn-primary" name="login">Login</button>

                <p class="form-text">Do you have an account? <a href="#" onclick="showForm('registerForm')">Register
                        here</a></p>

                <p class="">Admin Account: <br> <span class="form-text">Username: Admin | Password: Admin</span></p>
            </form>

        </div>



        <!-- Register Form -->

        <div class="text-center bg-light p-5 rounded shadow-lg <?php echo showForm('registerForm', $activeForm); ?>" id="registerForm">

            <h1>Register</h1>

            <?php echo showError($errors['register']); ?>

            <form action="login.php" method="post" enctype="multipart/form-data"
                class="form-group d-flex flex-column gap-3 mt-4">

                <input type="text" name="username" id="username" placeholder="Username" class="form-control mb-3 pe-5"
                    required>

                <input type="password" name="password" id="password" placeholder="Password"
                    class="form-control mb-3 pe-5" required>

                <select name="role" id="" class="form-control mb-3 pe-5" required>
                    <option value="" selected disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

                <button type="submit" class="btn btn-primary" name="register"
                    onclick="showForm('loginForm')">Register</button>

            </form>

        </div>

    </div>

    <script>
        function showForm(formId) {
            document.querySelectorAll("#loginForm, #registerForm").forEach(form => {
                form.classList.add("d-none");
            });
            document.getElementById(formId).classList.remove("d-none");
        }
    </script>
</body>

</html>