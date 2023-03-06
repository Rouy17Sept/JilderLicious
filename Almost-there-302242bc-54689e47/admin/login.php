<?php include_once('../partials/constants.php'); ?>

<!doctype html>
<head>
    <title>Login Admin YFOOD</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<form action="" method="post">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <?php
                if (isset($_SESSION['no-login'])) {
                    echo "<h1>" . $_SESSION['no-login'] . "</h1>";
                    unset($_SESSION['no-login']);
                }
                
                if (isset($_SESSION['no-login-message'])) {
                    echo "<h1>" . $_SESSION['no-login-message'] . "</h1>";
                    unset($_SESSION['no-login-message']);
                }
                ?>
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                    <div class="form-outline form-white mb-4">
                        <input type="text" id="typeEmailX" name="username" class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX">Username</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="typePasswordX">Password</label>
                    </div>

                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                    <button class="btn btn-outline-light btn-lg px-5" name="submit" type="submit">Login</button>

                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                    </div>

                    </div>

                    <div>

                    <!--
                    <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>

            -->

            
                    </p>
                    </div>

                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</form>

<?php

if (isset($_POST['submit'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                header('location: ' . SITEURL . 'admin/index.php');
            } else {
                $_SESSION['no-login'] = "<div class='error'>Username or Password did not match.</div>";
                header('location: ' . SITEURL . 'admin/login.php');
            }
        } else {
            $_SESSION['no-login'] = "<div class='error'>Username or Password did not match.</div>";
            header('location: ' . SITEURL . 'admin/login.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>