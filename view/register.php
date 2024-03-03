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
        <title>Register | PHP CRUD using OOPs & MVC</title>

        <?php include APP_PATH . "/resources/css.php"; ?>

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/__font.css">

    </head>

    <body style="height: fit-content; min-height: 100vh; min-width: 100vw;" class="py-4">
        <div class="container-fluid h-100">
            <div class="row d-flex align-items-center h-100">

                <form class="col-12 col-lg-5 p-5 mx-auto rounded-4 shadow-lg"
                      action="<?php echo $user->createUser(); ?>" method="post" enctype="multipart/form-data">

                    <div class="row text-center">
                        <h1>Registration</h1>
                    </div>
                    <hr>
                    <div class="row my-4 gap-3">
                        <div>
                            <label for="name"
                                   class="<?php echo !empty($user->email_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        <div>
                            <label for="email"
                                   class="<?php echo !empty($user->email_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Email</label>
                            <input type="email" class="form-control " id="email" name="email"
                                   placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="gender"
                                   class="form-label <?php echo !empty($user->gender_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Gender</label>
                            <br>
                            <div class="ps-4">
                                <input type="radio" name="gender" value="male" id="male">
                                <label for="male"
                                       class="form-check-label">Male</label>
                            </div>
                            <div class="ps-4">
                                <input type="radio" name="gender" value="female" id="female">
                                <label for="female"
                                       class="form-check-label">Female</label>
                            </div>
                        </div>

                        <div>
                            <label for="area_of_interest"
                                   class="form-label <?php echo !empty($user->area_of_interest_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Area
                                of Interest</label>
                            <select name="area_of_interest" id="area_of_interest" class="form-select">
                                <option value="" selected disabled>-- Select your area of interest --</option>
                                <option value="web_development">Web Development</option>
                                <option value="data_science">Data Science</option>
                                <option value="game_development">Game Development</option>
                                <option value="arvr_development">AR/VR Development</option>
                            </select>
                        </div>

                        <div>
                            <label for="technical_skills"
                                   class="form-label <?php echo !empty($user->tech_skills_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Technical
                                Skills</label>
                            <div id="technical_skills">
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="html" id="html"
                                           class="form-check-input">
                                    <label for="html" class="form-check-label">HTML</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="css" id="css"
                                           class="form-check-input">
                                    <label for="css" class="form-check-label">CSS</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="js" id="js"
                                           class="form-check-input">
                                    <label for="js" class="form-check-label">JS</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="jquery" id="jquery"
                                           class="form-check-input">
                                    <label for="jquery" class="form-check-label">JQuery</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="json" id="json"
                                           class="form-check-input">
                                    <label for="json" class="form-check-label">JSON</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="git" id="git"
                                           class="form-check-input">
                                    <label for="git" class="form-check-label">Git</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="ajax" id="ajax"
                                           class="form-check-input">
                                    <label for="ajax" class="form-check-label">AJAX</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="php" id="php"
                                           class="form-check-input">
                                    <label for="php" class="form-check-label">PHP</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="tech_skills[]" value="mysql" id="mysql"
                                           class="form-check-input">
                                    <label for="mysql" class="form-check-label">MySQL</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="password"
                                   class="form-label <?php echo !empty($user->password_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Enter your password">
                        </div>

                        <div>
                            <label for="pic"
                                   class="form-label <?php echo !empty($user->pic_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Profile
                                Picture</label>
                            <input type="file" class="form-control" name="pic" id="pic">
                        </div>
                    </div>
                    <div class="row justify-content-evenly">
                        <button type="submit"
                                class="w-100 w-lg-auto btn btn-dark text-nowrap"
                                name="register"><i class="fa-solid fa-user-pen pe-3"></i>Register</button>
                    </div>

                </form>
            </div>
        </div>

        <?php include APP_PATH . "/resources/scripts.php" ?>

    </body>


</html>