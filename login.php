<?php

include "config.php";
session_start();
if (isset($_SESSION['idk'])) {
    header("location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body, html {
        height: 100%;
    }
</style>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                <form method="post">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" name="mail" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" name="pass" class="form-control form-control-lg" />
                                    </div><br>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                                    <button class="btn btn-outline-light btn-lg px-5" name="submit" type="submit">Login</button>
                                    <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div> -->
                                </form>
                                <?php
                                
                                if (isset($_POST['submit'])) {
                                    $usermail = htmlspecialchars(htmlentities(mysqli_real_escape_string($db, $_POST['mail'])));
                                    $userpass = htmlspecialchars(htmlentities(mysqli_real_escape_string($db, $_POST['pass'])));

                                    $query = $db->query("SELECT * FROM user WHERE email_kdm = '$usermail' AND password_kdm = md5('$userpass')");
                                    $row = $query->fetch_assoc();
                                    if (mysqli_num_rows($query)>0) {
                                        $_SESSION['idk'] = $row['id_kdm'];
                                        $_SESSION['namek'] = $row['username_kdm'];
                                        $_SESSION['emailk'] = $row['email_kdm'];
                                        $_SESSION['genderk'] = $row['gender_kdm'];

                                        header('location: index.php?status=login');
                                        exit;
                                    } else {
                                        echo "<script>Swal.fire({
                                            title: '<strong>Opss...</strong>',
                                            text: 'Email atau Password Salah!',
                                            icon: 'error'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                              window.location.replace('login.php');
                                            }
                                          });</script>";
                                        exit;
                                    }
                                }


                                ?>
                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="registrasi.php" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 10%; margin-top: 50px;"></div>
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>