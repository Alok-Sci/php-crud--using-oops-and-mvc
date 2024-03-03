<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

include APP_PATH . '/controller/userController.php';
$user = new UserController;
?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | PHP CRUD using OOPs & MVC</title>

        <?php include APP_PATH . "/resources/css.php"; ?>

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/__font.css">

    </head>

    <body class="py-4">
        <div class="container-fluid h-100">
            <div class="row d-flex align-items-center h-100">

                <form class="col-12 col-lg-5 p-5 mx-auto rounded-4 shadow-lg "
                      action="<?php echo $user->login(); ?>" method="post">

                    <div
                         class="d-none <?php echo !empty($user->login_error) ? 'error-block d-block' : NULL; ?> ">
                        <p><i class="fa-solid fa-circle-exclamation pe-3"></i> <?php echo $user->login_error; ?></p>
                    </div>
                    <div class="row text-center">
                        <h1>Login</h1>
                    </div>
                    <hr>
                    <div class="row my-4 gap-3">
                        <div>
                            <label for="email"
                                   class="<?php echo !empty($user->email_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Email</label>
                            <input type="email" class="form-control " id="email" name="email"
                                   placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="password"
                                   class="form-label <?php echo !empty($user->password_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Enter your password">
                        </div>

                    </div>
                    <div class="row justify-content-evenly">
                        <button type="submit"
                                class="col-12 col-lg-5 btn btn-dark text-nowrap"
                                name="login"><i class="fa-solid fa-user-pen pe-3"></i>Login</button>
                    </div>

                </form>
            </div>
        </div>

        <?php include APP_PATH . "/resources/scripts.php" ?>

    </body>


</html>