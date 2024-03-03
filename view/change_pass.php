<?php

session_start();


require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

include APP_PATH . '/controller/userController.php';
$user = new UserController;

if (isset($_SESSION['email'])):
    ?>
    <!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Change Password | PHP CRUD using OOPs & MVC</title>

            <?php include APP_PATH . "/resources/css.php"; ?>

            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/__font.css">

        </head>

        <body class="py-4">
            <div class="container-fluid h-100">
                <div class="row d-flex align-items-center h-100">

                    <form class="col-12 col-lg-5 p-5 mx-auto rounded-4 shadow-lg "
                          action="<?php echo $user->changePassword(); ?>" method="post">

                        <div
                             class="d-none <?php echo !empty($user->changepass_error) ? 'error-block d-block' : NULL; ?> ">
                            <p><i class="fa-solid fa-circle-exclamation pe-3"></i> <?php  echo !empty($user->changepass_error) ? $user->changepass_error : NULL; ?></p>
                        </div>
                        <div class="row text-center">
                            <h1>Change Password</h1>
                        </div>
                        <hr>
                        <div class="row my-4 gap-3">
                            <div>
                                <label for="current_pass"
                                       class="<?php echo !empty($user->password_msg) ? 'has-error' : NULL; ?>">Current
                                    Password</label>
                                <input type="password" class="form-control " id="current_pass" name="current_pass"
                                       placeholder="Enter your current password">
                            </div>

                            <div>
                                <label for="new_pass"
                                       class="form-label <?php echo !empty($user->new_password_msg) ? 'has-error' : NULL; ?>">New
                                    Password</label>
                                <input type="text" class="form-control" name="new_pass" id="new_pass"
                                       placeholder="Enter new password">
                            </div>
                            <div>
                                <label for="confirm_pass"
                                       class="form-label <?php echo !empty($user->new_password_msg) ? 'has-error' : NULL; ?>">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_pass" id="confirm_pass"
                                       placeholder="Confirm your new password">
                            </div>

                        </div>
                        <div class="row justify-content-evenly">
                            <button type="submit"
                                    class="col-12 col-lg-5 btn btn-dark text-nowrap"
                                    name="change_password">Change Password
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <?php include APP_PATH . "/resources/scripts.php" ?>

        </body>


    </html>

    <?php
else:
    $user->logout();
endif;
?>