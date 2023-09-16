<?php 
namespace Mvc\Portfolio\controllers;

use \Exception;
use Mvc\Portfolio\models\Likes;
use Mvc\Portfolio\core\registry;


class Like extends AbstractController{

    public function Likehandeler($project)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }

        try{
            $project = registry::get("validation")->setValue(["project"=>$project])->fInteger()->getValue();
            
            $check = (new Likes) -> checkLikes($_SESSION['userId'],$project);
            
            if($check == 1){
                (new Likes) -> delLikes($_SESSION['userId'],$project);
            }else{
                (new Likes) -> addLikes($_SESSION['userId'],$project);
            }
            $count = (new Likes) -> getCountLikes($project);
            echo $count;
        }
        catch(Exception $e)
        {
            die;
        }
        die;
    }
}

?>