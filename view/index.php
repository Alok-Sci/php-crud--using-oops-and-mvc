<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

require_once APP_PATH . '/controller/userController.php';
$user = new UserController;

?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Home | PHP CRUD using OOPs & MVC</title>

        <?php include APP_PATH . "/resources/css.php" ?>

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/__font.css">


    </head>

    <body style="height: 100vh; min-width: 100vw;">
        <div class="container-fluid h-100 align-items-center">
            <div class="row d-flex align-items-center h-100 align-items-center">
                <div class="col-12 col-lg-8 text-center mx-auto">
                    <div class="row ">
                        <h1>PHP CRUD using OOPs & MVC architecture</h1>
                    </div>
                    <div class="row my-4">
                        <p>A simple project created for the understanding and practice of Model View Controller
                            (MVC)
                            architecture, Object Oriented Programming (OOPs), CRUD operations in PHP.</p>
                        <p>Made with 💝 by <a href="https://www.github.com/Alok-Sci" class="fw-semibold">Alok Singh</a>
                        </p>
                        <p>Thanks to <a href="https://www.thekraftors.com" class="fw-semibold">The Kraftors Web
                                Solutions Pvt. Ltd.</a></p>
                    </div>
                    <div class="row justify-content-evenly">
                        <a href="<?php echo $user->getUserRegister(); ?>"
                           class="col-3 btn btn-dark"><i class="fa-solid fa-user-pen pe-3"></i>Register</a>
                        <a href="<?php echo $user->getUserLogin(); ?>"
                           class="col-3 btn btn-dark"><i class="fa-solid fa-arrow-right-to-bracket pe-3"></i>Login</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include APP_PATH . "/resources/scripts.php" ?>

    </body>

</html>