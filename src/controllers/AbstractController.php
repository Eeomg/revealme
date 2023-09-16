<?php 

    namespace Mvc\Portfolio\controllers;
    use Mvc\Portfolio\core\session;

    abstract class AbstractController
    {

        public function sessionhandeler()
        {
            return isset($_SESSION['userId']);
        }

        public function view($page,array $data)
        {
            $file = "../src/views/".$page.'.php';
            if(file_exists($file)){
                extract($data);
                ob_start();
                include($file);
                ob_end_flush();
            }else{
                redirect("/Error/index/404 Not Found");
            }
        }
    }