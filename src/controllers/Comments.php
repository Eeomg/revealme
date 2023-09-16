<?php 
namespace Mvc\Portfolio\controllers;

use \Exception;
use Mvc\Portfolio\core\registry;
use Mvc\Portfolio\models\Comment;


class Comments extends AbstractController{
    
    public function addComments($project,$comment)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        try{
            $comment = registry::get("validation")->setValue(["comment"=>$comment])->fString()->getValue();
            $project = registry::get("validation")->setValue(["project"=>$project])->fInteger()->getValue();
            $commentid = (new Comment) -> addComment($_SESSION['userId'],$comment,$project);
            $count = (new Comment) -> getCountComments($project);
            echo $count.'{thismydata}
            <div class="post postcomment">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm" src='. assets("admin/dist/img/".$_SESSION['userAvatar']).' alt="user image">
                    <span class="username">
                        <a href="/Profile/index/'.$_SESSION['userId'].'">
                        '.$_SESSION['userName'].'
                        </a>
                    </span>
                    <span class="description">'.date('Y-m-d H:i:s').'</span>
                    <a class="float-right btn-tool" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item deletecomment" commentid="'.$commentid.'">Delete comment</a>
                  </div>
                </div>
                <!-- /.user-block -->
                <p>
                    '. $comment .'
                </p>
            </div>
            ';
        }catch(Exception $e){
            die;
        }
        die;
    }

    public function delComment($commentid)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        try{
            $commentid = registry::get("validation")->setValue(["comment"=>$commentid])->fString()->getValue();
            echo (new Comment) -> delComments($_SESSION['userId'],$commentid);
        }catch(Exception $e){
            die;
        }
        die;
    }
}
?>
