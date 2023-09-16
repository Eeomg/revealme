<?php 


namespace Mvc\Portfolio\controllers;

use Exception;
use Mvc\Portfolio\controllers\AbstractController;
use Mvc\Portfolio\models\projects;


    class Home extends AbstractController
    {
        public function index()
        {
            $check = $this -> sessionhandeler();
            if(!$check){
                redirect("/home/signin");
                die;
            }
            try
            {
                $data = [];
                $data['title'] = 'Home';
                $data['count'] = (new projects) -> getFriendsProjectsCount($_SESSION['userId']);
                $data['projects'] = (new projects) -> getFriendsProjects($_SESSION['userId']);
                $this -> view('index',$data);
            }
            catch(Exception $e)
            {
                redirect("/Error/index/404 Not Found");
            }

        }

        public function signIn()
        {
            $check = $this -> sessionhandeler();
            if($check){
                redirect("/");
                die;
            }
            $data = [];
            $data['title'] = 'Reveal me | sign in';
            $data['error'] = (isset($_SESSION['error'])) ? $_SESSION['error'] : "";
            $this -> view('signin',$data);
            (isset($_SESSION['error'])) ? $_SESSION['error'] = "" : "";
            
        }

        public function signUp()
        {
            $check = $this -> sessionhandeler();
            if($check){
                redirect("/");
                die;
            }
            $data['title'] = 'Reveal me | sign up';
            $data['error'] = (isset($_SESSION['error']))? $_SESSION['error'] : "";
            $this -> view('signup',$data);
            (isset($_SESSION['error'])) ? $_SESSION['error'] = "" : "";
            
        }
        
        public function logout()
        {
            session_start();
            session_unset();
            session_destroy();
            redirect('/home/signin');
        }
    }