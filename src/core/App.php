<?php 


    namespace Mvc\Portfolio\core;

    use Exception;
    use ReflectionMethod;

    class App
    {
        private $controller;
        private $method;
        private $params;

        function __construct($controller  = 'Home' ,$method = 'index',$params = [])
        {
            $this -> controller = $controller ;
            $this -> method = $method ;
            $this -> params = $params ;
            $this -> url();
            $this -> render();
        }

        function url()
        {
            // $_SERVER['QUERY_STRING'] = Profile/index/7/HG/HHG/JH/JH => ['Profile','index','7/HG/HHG/JH/JH ']

            $url = explode('/',$_SERVER['QUERY_STRING'],3);

            $this -> controller = (empty($url[0])) ?  $this -> controller : $url[0];
            // method
            $this -> method     = (empty($url[1])) ?  $this -> method : $url[1];
            //  parameters
            $this -> params     = (empty($url[2])) ?  $this -> params : explode("/",$url[2]);
        }

        function render()
        {
            $controller = "Mvc\\Portfolio\\controllers\\".$this -> controller; 
            $method = $this->method;
            if(class_exists($controller))
            {
                $controller = new $controller;
                
                if(method_exists($controller,$method))
                {
                    $reflection = new ReflectionMethod($controller, $method);
                    if ($reflection->isPublic()) {
                        $methodparam = $reflection->getNumberOfParameters();
                        $paramslen = count($this -> params);
                        if($methodparam == $paramslen){
                            call_user_func_array([$controller,$method],$this -> params);
                        }else{
                            echo "404 not found";
                        }
                    }else{
                        echo "404 not found";
                    }
                }else{
                    echo "404 not found";
                }
            }else{
                echo "404 not found";
            }
        }
    }