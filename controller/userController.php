<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

include APP_PATH . '/model/userModel.php';
require_once APP_PATH . '/model/userTbl.php';


// 1. get inputs 
// 2. validate inputs 
// 3.1 if valid : call model's insertRecord function by passing the $user object as arg 
// 3.2 if invalid: display error messages 


class UserController
{
    public $login_error;
    public $login_success;
    public $update_success;
    public $update_error;
    public $changepass_error;

    public function __construct()
    {

        // pass the db object as argument to the RegisterModel constructor function
        $this->userModel = new UserModel();

        $this->login_error
            = $this->login_success
            = $this->register_error
            = $this->register_success
            = $this->update_error
            = $this->update_success
            = $this->changepass_error
            = NULL;
    }

    // Handle page requests and route them to the corresponding views 
    function pageHandler()
    {
        if (isset($_REQUEST['register'])) {
            $res = $this->createUser();

            // if user is created successfully then show the success message 
            if ($res) {
                // display success message 
                $this->register_success = "Registration SuccessFull";
            } else {

            }
        } else if (isset($_REQUEST['login'])) {
            $this->login();
        } else {
            include_once 'view/index.php';
        }
    }

    // function to open registration page 
    public function getUserRegister()
    {
        return 'view/register.php';
    }

    // function to open login page 
    public function getUserLogin()
    {
        return 'view/login.php';
    }

    // create user 
    public function createUser()
    {

        if (isset($_REQUEST['register'])) {
            // create an object of user table
            $userTbl = new UserTbl;

            // assign corresponding data 
            $userTbl->name             = $_POST['name'];
            $userTbl->email            = $_POST['email'];
            $userTbl->gender           = $_POST['gender'];
            $userTbl->area_of_interest = $_POST['area_of_interest'];
            $userTbl->tech_skills      = implode(', ', $_POST['tech_skills']);
            $userTbl->password         = $this->encryptPass($_POST['password']);
            $userTbl->pic              = str_replace(' ', '_', $_FILES['pic']['name']) . time();


            // if email already exist then return an error 


            $pic_temp_filename = $_FILES['pic']['tmp_name'];
            $location          = '../assets/uploads/';

            // echo "<pre>";
            // print_r($userTbl);
            // echo "</pre>";

            // check if the inputs are valid 
            $isValid = $this->validateRegistration($userTbl);

            // if inputs are valid then create new user 
            if ($isValid) {
                $userModel = new UserModel();
                $res       = $userModel->createUser($userTbl);
                if ($res) {
                    // $this->showSuccess('Registration Successfull');
                    move_uploaded_file($pic_temp_filename, $location . $userTbl->pic);
                    // return '../index.php?login';
                    $this->redirect('../view/login.php');
                }
            } else {
                print "Unable to insert";
            }
        }

        return NULL;
    }


    // public function showSuccess($msg)
    // {

    // }

    // login user 
    public function login()
    {
        // print "login";
        if (isset($_REQUEST['login'])) {
            $userTbl           = new UserTbl;
            $userTbl->email    = $_POST['email'];
            $userTbl->password = $this->encryptPass($_POST['password']);

            // echo "hello";
            $isValid = $this->validateLogin($userTbl);
            // $isValid = true;

            if ($isValid) {
                $userModel = new UserModel();
                $userRes   = $userModel->getUserByEmail($userTbl->email);
                // $userRes;
                // print $userRes['password'];
                if ($userRes) {
                    if ($userRes[0]['email'] === $userTbl->email && $userRes[0]['password'] === $userTbl->password) {

                        $this->login_success = true;
                        session_start();
                        $_SESSION['email'] = $userRes[0]['email'];

                        $this->redirect('../view/dashboard.php');

                        $this->login_success = "Login Successfull";
                        return '../view/dashboard.php';
                    }
                    // return '../view/dashboard.php';
                } else {
                    $this->redirect('../view/login.php');

                    $this->login_error = "Invalid Email or Password";
                    return '#';
                }
            }
        }
        // if all the inputs are valid then fire the query using model's method 
    }

    public function getUserByEmail()
    {
        if (isset($_SESSION['email'])) {

            $userModel = new UserModel;
            $userRes   = $userModel->getUserByEmail($_SESSION['email']);
            if ($userRes) {
                $userTbl = new UserTbl;

                $userTbl->name             = $userRes[0]['name'];
                $userTbl->email            = $userRes[0]['email'];
                $userTbl->gender           = $userRes[0]['gender'];
                $userTbl->area_of_interest = $userRes[0]['area_of_interest'];
                $userTbl->tech_skills      = $userRes[0]['tech_skills'];
                $userTbl->tech_skills      = $userRes[0]['tech_skills'];
                $userTbl->pic              = $userRes[0]['pic'];

                return $userTbl;
            }
        }

    }

    public function editUser()
    {
        // if type of edit key has value then it's called from admin 
        if (!empty(isset($_REQUEST['edit']))) {
            $edit_id = $_REQUEST['edit'];

            // open update form 
            $this->redirect('../view/admin_update.php' . strval($edit_id));
            return '../view/admin_update.php?' . $edit_id;
            // $userModel = new UserModel;
            // $userModel->updateUser($userTbl->id, $userData);

        }
        // if type of edit key has some value then it's called from user 
        else if (empty(isset($_REQUEST['edit']))) {
            // fetch data using email 
            $userModel = new UserModel;
            $userData  = $userModel->getUserByEmail($_SESSION['email']);
            // get id of the user using session 
            if ($userData) {
                $this->id = $userData[0]['email'];
            }
            $this->redirect('../view/update.php');
            return '../view/update.php';
        }
    }

    public function changePassword()
    {
        if (isset($_REQUEST['change_password'])) {
            $userTbl           = new UserTbl;
            $userTbl->email    = $_SESSION['email'];
            $userTbl->password = $this->encryptPass($_POST['current_pass']);

            $userModel = new UserModel;

            // get user data from db 
            $userData = $userModel->getUserByEmail($userTbl->email);

            // if data is fetched from db and password in db matches the current password entered by user 
            if (print !empty($userData) && $userData[0]['password'] === $userTbl->password) {

                // then check if the new password and confirm password matches 
                if ($_POST['new_pass'] === $_POST['confirm_pass']) {

                    // then encrypt the password with $this->encryptPass hash function 
                    print $encrypted_pass = $this->encryptPass($_POST['new_pass']);

                    // then if password updated successfully then logout the user 
                    if ($userModel->updatePassword($userTbl->email, $encrypted_pass)) {
                        // password changed successfully
                        $this->logout();
                        // return '../view/login.php';
                    } else {
                        $this->updatepass_error = "Some error occurred while updating the password!";
                        return '../view/change_pass.php';
                    }
                } else {
                    $this->changepass_error = "Password does not match";
                    return '../view/change_pass.php';
                }
            } else {
                $this->changepass_error = "Invalid Old Password!";
                return '../view/change_pass.php';
            }
        }
    }

    // encrypt password 
    public function encryptPass($pass)
    {
        return sha1($pass);
    }


    // update user information 
    public function updateUser()
    {
        if (isset($_REQUEST['update'])) {
            $userModel = new UserModel;
            $userTbl   = new UserTbl;

            $userTbl->name             = $_POST['name'];
            $userTbl->email            = $_POST['email'];
            $userTbl->gender           = $_POST['gender'];
            $userTbl->area_of_interest = $_POST['area_of_interest'];
            $userTbl->tech_skills      = implode(', ', $_POST['tech_skills']);

            // print_r($userTbl);

            $isValid = $this->validateUpdate($userTbl);
            // echo ($isValid);
            if ($isValid) {
                // get the id from query parameter 
                if ($userModel->updateUser($_SESSION['email'], $userTbl)) {
                    $this->update_success = "Update Successfull!";
                    // $this->redirect('../view/dashboard.php');
                    return '../view/dashboard.php';
                } else {
                    $this->update_error = "Can't be updated!";
                    // $this->redirect('../view/edit.php');
                    return '../view/edit.php';
                }
            }
        }
    }


    public function updateUserByEmail()
    {
        $userModel = new UserModel;
        $userTbl   = new UserTbl;

        // updated information 
        $userTbl->id               = $_REQUEST['id'];
        $userTbl->name             = $_POST['name'];
        $userTbl->email            = $_POST['email'];
        $userTbl->gender           = $_POST['gender'];
        $userTbl->area_of_interest = $_POST['area_of_interest'];
        $userTbl->tech_skills      = implode(', ', $_POST['tech_skills']);

        // check if the form data is valid 
        $isValid = $this->validateUpdate($userTbl);

        // get user data 
        $userData = $userModel->getUserById($userTbl->id);

        if ($isValid && $userData) {
            if ($userModel->updateUser($userData[0]['email'], $userTbl)) {
                $this->update_success = "Information Updated Successfully!";
            } else {
                $this->update_error = "Some error occurred! Some error occurred ";
            }
        }
    }


    // public function deleteUser()
    // {
    //     if (isset($_REQUEST['delete'])) {
    //         $userTbl = new UserTbl;
    //         $userTbl->id = $_REQUEST['delete'];
    //     }
    // }

    // function to logout 
    public function logoutBtn()
    {
        if (isset($_REQUEST['logout'])) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            session_destroy();

            $this->redirect('../view/login.php');
        }
    }
    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();

        $this->redirect('../view/login.php');
    }

    // redirect to a url 
    public function redirect($url)
    {
        header("Location:" . $url);
    }


    // validate registration inputs 

    public function validateRegistration($user)
    {
        $noerror = true;

        if (empty($user->name)) {
            $this->name_msg = 'Name field is empty!';
            $noerror        = false;
        }

        if (empty($user->email)) {
            $this->email_msg = 'Email field is empty!';
            $noerror         = false;
        }

        if (empty($user->gender)) {
            $this->gender_msg = 'Gender field is no selected!';
            $noerror          = false;
        }


        if (empty($user->area_of_interest)) {
            $this->area_of_interest_msg = 'No Area of interest selected!';
            $noerror                    = false;
        }


        if (empty($user->tech_skills)) {
            $this->tech_skills_msg = 'Tech skills cannot be empty!';
            $noerror               = false;
        }


        if (empty($user->password)) {
            $this->password_msg = 'Password field is empty!';
            $noerror            = false;
        }


        if (empty($user->pic)) {
            $this->pic_msg = 'No image uploaded!';
            $noerror       = false;
        }


        return $noerror;

    }

    public function validateUpdate($user)
    {
        $noerror = true;

        if (empty($user->name)) {
            $this->name_msg = 'Name field is empty!';
            $noerror        = false;
        }

        if (empty($user->email)) {
            $this->email_msg = 'Email field is empty!';
            $noerror         = false;
        }

        if (empty($user->gender)) {
            $this->gender_msg = 'Gender field is no selected!';
            $noerror          = false;
        }


        if (empty($user->area_of_interest)) {
            $this->area_of_interest_msg = 'No Area of interest selected!';
            $noerror                    = false;
        }


        if (empty($user->tech_skills)) {
            $this->tech_skills_msg = 'Tech skills cannot be empty!';
            $noerror               = false;
        }

        return $noerror;

    }


    // validate login inputs 
    public function validateLogin($user)
    {
        $noerror = true;

        if (empty($user->email)) {
            $this->email_msg = 'Email field is empty!';
            $noerror         = false;
        }
        if (empty($user->password)) {
            $this->password_msg = 'Password field is empty!';
            $noerror            = false;
        }

        return $noerror;

    }


}

?>