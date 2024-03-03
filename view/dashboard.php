<?php
session_start();
// echo "This is session: " . $_SESSION['email'];


require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

include APP_PATH . '/controller/userController.php';
$user = new UserController;

// if session is present then load the page 
if (!empty(isset($_SESSION['email']))) {

    // get user's data
    $userData = $user->getUserByEmail();

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

        <body style="height: clamp(100vh, 100%, fit-content; min-width: 100vw;" class="py-md-4">
            <div class="container-fluid h-100">
                <div class="row d-flex align-items-center h-100 ">
                    <div class="col-lg-8 shadow-lg rounded-4 p-5 mx-auto">

                        <div class="row text-center">
                            <h1 class="form-title">Dashboard</h1>
                        </div>
                        <hr>
                        <div class="row my-4 gap-3">
                            <div class="col-12 text-center">
                                <div class="row justify-content-center">
                                    <picture class="p-0 col-8 col-lg-4 border border-2 border-dark rounded-circle overflow-hidden"
                                             >
                                        <img src="../assets/uploads/<?php echo $userData->pic ?>"
                                             alt="your picture"
                                             class="img-fluid">
                                    </picture>
                                </div>
                                <p class="mt-4 fs-3"><b>Welcome, <?php echo ucwords($userData->name); ?>! </b></p>
                            </div>
                        </div>
                        <div class="row justify-content-between gap-2">
                            <a href="../view/edit.php"
                               class="btn btn-dark text-nowrap fs-6 fs-lg-5"><i class="fa-solid fa-user-pen pe-3"></i>Edit
                                Profile</a>
                            <a href="../view/change_pass.php"
                               class="btn btn-dark text-nowrap fs-6 fs-lg-5"><i class="fa-solid fa-key pe-3"></i>Change Password</a>

                            <form class="px-0" action="<?php echo $user->logoutBtn(); ?>">
                                <button type="submit" name="logout"
                                        class="col-12 col-lg-3 btn w-100 btn-dark text-nowrap fs-6 fs-lg-5"><i class="fa-solid fa-arrow-right-from-bracket pe-3"></i>Logout</button>
                            </form>
                        </div>

                        </form>

                    </div>
                </div>
            </div>

            <?php include APP_PATH . "/resources/scripts.php" ?>

        </body>


    </html>

    <?php
} else {
    $user->logout();
}
?>