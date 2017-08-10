<?php

/**
 * Created by PhpStorm.
 * User: Melaine
 * Date: 06/08/2017
 * Time: 14:07
 */
class Admin
{


    public $id;
    public $type;
    public $name;
    public $login;

    /**********************/
    public $password;
    public $password_changed;
    public $remaining_token;
    public $regret_point;
    public $extra_case;
    public $date_inscription;



    function __construct($name)
    {
        $this->name=$name;
    }


        function updateData($id,$type)
    {
        $this->id=$id;
        $this->type=$type;
    }


    function initNoneAttribute()
    {
        $this->password="";
        $this->password_changed=1;
        $this->remaining_token="";
        $this->regret_point=0;
        $this->date_inscription="";
    }




}