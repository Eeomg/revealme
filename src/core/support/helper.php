
<?php

    function redirect($path){
        header("location: {$path}");
    }
    
    function assets($path){
        return $_SERVER['REQUEST_SCHEME'] . '://'.$_SERVER['HTTP_HOST']."/".$path;
    }

