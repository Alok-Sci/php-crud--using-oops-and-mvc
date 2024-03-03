<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

include APP_PATH . '/controller/userController.php';
$user = new UserController;

if (isset($_SESSION['email'])) {
    $userModel = new UserModel;
    $data      = $userModel->getUserByEmail($_SESSION['email']);
    ?>
    <!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit | PHP CRUD using OOPs & MVC</title>

            <?php include APP_PATH . "/resources/css.php"; ?>

            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/__font.css">

        </head>

        <body style="height: fit-content; min-height: 100vh; min-width: 100vw;" class="py-4">
            <div class="container-fluid h-100">
                <div class="row d-flex align-items-center h-100 p-3">

                    <form class="col-12 col-lg-8 p-5 mx-auto rounded-4 shadow-lg <?php echo !empty($user->update_success) ? 'border border-2 border-success' : (!empty($user->update_error) ? 'border border-2 border-danger' : NULL); ?>"
                          action="<?php echo $user->updateUser(); ?>" method="post">

                        <div class="row text-center ">
                            <h1>Update Information</h1>
                        </div>
                        <hr>
                        <div class="row text-center my-2 <?php echo !empty($user->update_success) ? 'text-success' : (!empty($user->update_error) ? 'text-danger' : NULL);?> ">
                            <p>
                                <?php echo !empty($user->update_success) ? "<i class=\"fa-solid fa-circle-check pe-3\"></i>" . $user->update_success : (!empty($user->update_error) ? "<i class=\"fa-solid fa-circle-exclamation pe-3\"></i>". $user->update_error : NULL); ?>
                            </p>
                        </div>
                        <div class="row my-4 gap-3">
                            <div class="col-12 col-lg-5 flex-grow-1">
                                <label for="name"
                                       class="<?php echo !empty($user->email_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                                       value="<?php echo $data[0]['name'] ?>">
                            </div>
                            <div class="col-12 col-lg-5 flex-grow-1">
                                <label for="email"
                                       class="<?php echo !empty($user->email_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Email</label>
                                <input type="email" class="form-control " id="email" name="email"
                                       placeholder="Enter your email"
                                       value="<?php echo $data[0]['email'] ?>">
                            </div>

                            <div class="col-12 col-lg-5 flex-grow-1">
                                <label for="gender"
                                       class="form-label <?php echo !empty($user->gender_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Gender</label>
                                <br>
                                <div class="ps-4">
                                    <input type="radio" name="gender" value="male" id="male" <?php echo $data[0]['gender'] === 'male' ? 'checked' : NULL; ?>>
                                    <label for="male"
                                           class="form-check-label">Male</label>
                                </div>
                                <div class="ps-4">
                                    <input type="radio" name="gender" value="female" id="female" <?php echo $data[0]['gender'] === 'female' ? 'checked' : NULL; ?>>
                                    <label for="female"
                                           class="form-check-label">Female</label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5 flex-grow-1">
                                <label for="area_of_interest"
                                       class="form-label <?php echo !empty($user->area_of_interest_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Area
                                    of Interest</label>
                                <select name="area_of_interest" id="area_of_interest" class="form-select">
                                    <option value="" selected disabled>-- Select your area of interest --</option>
                                    <option value="web_development" <?php echo $data[0]['area_of_interest'] === 'web_development' ? 'selected' : NULL; ?>>Web
                                        Development</option>
                                    <option value="data_science" <?php echo $data[0]['area_of_interest'] === 'data_science' ? 'selected' : NULL; ?>>Data Science</option>
                                    <option value="game_development" <?php echo $data[0]['area_of_interest'] === 'game_development' ? 'selected' : NULL; ?>>Game
                                        Development</option>
                                    <option value="arvr_development" <?php echo $data[0]['area_of_interest'] === 'arvr_development' ? 'selected' : NULL; ?>>AR/VR
                                        Development</option>
                                </select>
                            </div>

                            <div>
                                <label for="technical_skills"
                                       class="form-label <?php echo !empty($user->tech_skills_msg) ? 'has-error' : NULL; ?> fs-5 fw-bold">Technical
                                    Skills</label>
                                <?php $tech_skills_arr = explode(", ", $data[0]['tech_skills']) ?>
                                <div id="technical_skills">
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="html" id="html"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'html' ? 'checked' : NULL; ?>>
                                        <label for="html" class="form-check-label">HTML</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="css" id="css"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'css' ? 'checked' : NULL; ?>>
                                        <label for="css" class="form-check-label">CSS</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="js" id="js"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'js' ? 'checked' : NULL; ?>>
                                        <label for="js" class="form-check-label">JS</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="jquery" id="jquery"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'jquery' ? 'checked' : NULL; ?>>
                                        <label for="jquery" class="form-check-label">JQuery</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="json" id="json"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'json' ? 'checked' : NULL; ?>>
                                        <label for="json" class="form-check-label">JSON</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="git" id="git"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'git' ? 'checked' : NULL; ?>>
                                        <label for="git" class="form-check-label">Git</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="ajax" id="ajax"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'ajax' ? 'checked' : NULL; ?>>
                                        <label for="ajax" class="form-check-label">AJAX</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="php" id="php"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'php' ? 'checked' : NULL; ?>>
                                        <label for="php" class="form-check-label">PHP</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tech_skills[]" value="mysql" id="mysql"
                                               class="form-check-input" <?php foreach ($tech_skills_arr as $item)
                                                   echo $item === 'mysql' ? 'checked' : NULL; ?>>
                                        <label for="mysql" class="form-check-label">MySQL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-evenly">
                            <button type="submit"
                                    class="col-sm-3 col-md-auto btn btn-dark text-nowrap w-sm-auto px-md-5"
                                    name="update"><i class="fa-solid fa-user-pen pe-3"></i>Update</button>
                        </div>

                    </form>
                </div>
            </div>

            <?php include APP_PATH . "/resources/scripts.php" ?>

        </body>


    </html>

    <?php
} else {
    $user->logout();
}