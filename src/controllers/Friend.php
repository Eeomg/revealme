<?php 
namespace Mvc\Portfolio\controllers;

use \Exception;
use Mvc\Portfolio\models\friends;
use Mvc\Portfolio\core\registry;


class Friend extends AbstractController
{
    
    public function friendHandeler($friend_id)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        try
        {
            $friend_id = registry::get("validation")->setValue(["friend_id"=>$friend_id])->fInteger()->getValue();
            $check = (new friends) -> checkFriendsStatus($_SESSION['userId'],$friend_id);
            if($check == 1 || $check == 0 )
            {
                (new friends) -> delFriend($_SESSION['userId'],$friend_id,$check);
                echo 3;
            }
            elseif($check == 2)
            {
                echo (new friends) -> confirmFriend($_SESSION['userId'],$friend_id); 
            }
            else
            {
                (new friends) -> addFriend($_SESSION['userId'],$friend_id);
                echo 0;
            }
        }
        catch(Exception $e)
        {
            die;
        }
        die;
    }

    public function confirmFriend($friend_id)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        
        try{
            $friend_id = registry::get("validation")->setValue(["friend_id"=>$friend_id])->fInteger()->getValue();
            echo (new friends) -> confirmFriend($_SESSION['userId'],$friend_id); 
        }catch(Exception $e)
        {
            die;
        }
        die;
    }

}