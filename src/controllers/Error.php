<?php 
namespace Mvc\Portfolio\controllers;

use  Mvc\Portfolio\controllers\AbstractController;

    class Error extends AbstractController{
        public function index($error_message)
        {
            $check = $this -> sessionhandeler();
            if(!$check){
                redirect("/home/signin");
                die;
            }
            $this -> view("error",['error'=>$error_message]);
        }
    }