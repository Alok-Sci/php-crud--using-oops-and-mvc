<?php

class UserTbl
{

    public $id;
    public $name;
    public $email;
    public $gender;
    public $area_of_interest;
    public $tech_skills;
    public $pic;
    public $password;

    function __construct()
    {
        $this->id = 0;
        $this->name 
        = $this->email 
        = $this->gender 
        = $this->area_of_interest 
        = $this->tech_skills 
        = $this->pic
        = $this->password = NULL;
    }
}