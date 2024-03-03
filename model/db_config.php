<?php 

class Mysql {
    public $host, $user, $db_pass, $db_name;
    
    function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->db_pass = "";
        $this->db_name = "db_the_kraftors";
    }
}