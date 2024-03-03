<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/the-kraftors/29feb2024--php-crud--using-oops-and-mvc/config.php';

require_once APP_PATH . '/model/userTbl.php';
include APP_PATH . '/model/db_config.php';


class UserModel
{

    public $conn;
    public $host;
    public $user;
    public $db_pass;
    public $db_name;
    public $db;


    function __construct()
    {
        $this->db = new Mysql;
    }

    function open_db()
    {
        $this->conn = mysqli_connect($this->db->host, $this->db->user, $this->db->db_pass, $this->db->db_name);
    }

    function close_db()
    {
        mysqli_close($this->conn);
    }

    // create a user 
    function createUser($data)
    {
        $this->open_db();
        $query = "INSERT INTO tbl_user(name, email, gender, area_of_interest, tech_skills, pic, password) VALUES ('$data->name', '$data->email', '$data->gender', '$data->area_of_interest', '$data->tech_skills', '$data->pic', '$data->password')";
        $res   = mysqli_query($this->conn, $query);
        $this->close_db();

        return $res;
    }

    // get user information using email 
    function getUserByEmail($email)
    {
        $this->open_db();

        // $tbl   = new UserTbl;
        $query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $res   = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_array($res)) {
            $data[] = $row;
        }
        // echo '<pre>';
        $data;
        // echo '</pre>';

        $this->close_db();

        // return data if present, else return null 
        return $data ?? NULL;
    }

    // get user data using id 
    function getUserById($id)
    {
        $this->open_db();

        // $tbl   = new UserTbl;
        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $res   = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_array($res)) {
            $data[] = $row;
        }
        // echo '<pre>';
        // echo $data;
        // echo '</pre>';

        $this->close_db();

        // return data if present, else return null 
        return $data ?? NULL;
    }

    // update user information 
    function updateUser($email, $data)
    {
        // print $email;
        // print_r($data);

        $this->open_db();
        $query = "UPDATE tbl_user SET name = '$data->name', email = '$data->email', gender = '$data->gender', area_of_interest = '$data->area_of_interest', tech_skills = '$data->tech_skills' WHERE email = '$email'";
        $res   = mysqli_query($this->conn, $query);
        $this->close_db();

        return $res;
    }

    function updatePassword($email, $new_pass)
    {
        print $email;
        print_r($new_pass);

        $this->open_db();
        print $query = "UPDATE tbl_user SET password = '$new_pass' WHERE email = '$email'";
        $res   = mysqli_query($this->conn, $query);

        print_r($res);

        $this->close_db();

        return $res;
    }


    function deleteUser($id)
    {
        $this->open_db();
        $query = "DELETE FROM tbl_user WHERE id = '$id'";
        $res   = mysqli_query($this->conn, $query);
        $this->close_db();

        return $res;
    }

}