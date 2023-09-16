<?php 

namespace Mvc\Portfolio\controllers;

use Exception;
use Mvc\Portfolio\models\users;
use Mvc\Portfolio\controllers\AbstractController;
use Mvc\Portfolio\core\registry;
use Mvc\Portfolio\models\friends;
use Mvc\Portfolio\models\Projects;

class Profile extends AbstractController{

    public function index($id)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
            try{
                $id = registry::get("validation")->setValue(['id' => $id])->fInteger()->getValue();
                $data = (new users) -> getAllUserData(['id' => $id]);
                if($data){
                    $data['title'] = 'Profile';
                    $data['myprofile'] = $this -> profileValidation($id);
                    // echo "<pre>";
                    // print_r($data);
                    // die;
                    $this -> view('admin', $data);
                }else{
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            }
            catch(Exception $e)
            {
                redirect("/Error/index/404 Not Found");
                die;
            }
        
    }

    public function settings()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
            try{
                $data = (new users) -> getMainUserData(['id' => $_SESSION['userId']]);
                if($data){
                    $data['title'] = 'Reveal me | profile settings';
                    $data['error'] = (isset($_SESSION['error'])) ? $_SESSION['error'] : "";
                    $this -> view('settings',$data);
                    (isset($_SESSION['error'])) ? $_SESSION['error'] = "" : "";
                }else{
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            }
            catch(Exception $e)
            {
                redirect("/Error/index/404 Not Founda");
                die;
            }
        

    }

    public function editMain()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['phone'])&&isset($_POST['password'])&&isset($_POST['job'])&&isset($_FILES['img'])){
                try
                {
                    $name     = registry::get("validation")->setValue(["name"=>$_POST['name']])->fString()->getValue();
                    $email    = registry::get("validation")->setValue(["email"=>$_POST['email']])->fEmail()->getValue();
                    $phone    = registry::get("validation")->setValue(["phone"=>$_POST['phone']])->fInteger()->getValue();
                    $job      = registry::get("validation")->setValue(["job"=>$_POST['job']])->fString()->getValue();
                    $password = registry::get("validation")->setValue(["password"=>$_POST['password']])->fPassword()->hash()->getValue();
                    if(!empty($_FILES['img']['name'])){
                        $image    = registry::get("validation")->setValue(["images"=>$_FILES['img']])->fImage()->getValue();
                    }else{
                        $image = '';
                    }
                    (new users) -> editMainData($name,$email,$phone,$job,$password,$image,$_SESSION['userId']);
                    redirect("/Profile/settings");
                    die;
                }
                catch(Exception $e)
                {
                    $_SESSION['error'] =  $e->getMessage();
                    redirect("/Profile/settings");die;
                    die;
                }
            }
        }
        redirect("/Error/index/404 Not Foundkjj");die;
        die;
    }

    public function editAvatr()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_FILES['img'])){
                $img = $_FILES['img'] ;
                try{
                    $img = registry::get("validation")->setValue(['image'=>$img])->fImage()->getValue();
                    (new users) -> editAvatar($img,$_SESSION['userId']);
                    redirect("/profile/index/".$_SESSION['userId']);
                    die;
                }
                catch(Exception $e)
                {
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            }
        }
        redirect("/Error/index/404 Not Found");
        die;
    }

    public function delavatar()
    {
        $img = "User.webp";
        try{
            (new users) -> editAvatar($img,$_SESSION['userId']);
            redirect("/profile/index/".$_SESSION['userId']);
            die;
        }
        catch(Exception $e)
        {
            redirect("/Error/index/404 Not Found");
            die;
        }
    }

    public function editEduc()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['educat'])){
    
                try{
                    $educ = registry::get("validation")->setValue(["education"=>$_POST['educat']])->fString()->getValue();
                    (new users) -> editEduc($educ,$_SESSION['userId']);
                    redirect("/profile/index/".$_SESSION['userId']);
                    die;
                }
                catch(Exception $e)
                {
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            }
        }
        redirect("/Error/index/404 Not Found");
        die;

    }

    public function editDisc()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['disc'])){
    
                try{
                    $disc = registry::get("validation")->setValue(["discription"=>$_POST['disc']])->fString()->getValue();
                    $edit = (new users) -> editDisc($disc,$_SESSION['userId']);
                    redirect("/profile/index/".$_SESSION['userId']);
                    die;
                }
                catch(Exception $e)
                {
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            } 
        }
        redirect("/Error/index/404 Not Found");
        die;
    }
   
    public function addPost()
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['disc'])){
                try{
                    $disc = registry::get("validation")->setValue(["discription"=>$_POST['disc']])->fString()->getValue();
                    (new Projects) -> addProject($_SESSION['userId'],$disc);
                    redirect("/profile/index/".$_SESSION['userId']);
                    die;
                }catch(Exception $e){
                    redirect("/Error/index/404 Not Found");
                    die;
                }
            }
        }
        redirect("/Error/index/404 Not Found");
        die;
    }

    public function delPost($postid)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }
        try{
            $postid = registry::get("validation")->setValue(["post id"=>$postid])->fInteger()->getValue();
            (new Projects) -> delProject($_SESSION['userId'],$postid);
            redirect("/profile/index/".$_SESSION['userId']);
            die;
        }catch(Exception $e){
            redirect("/Error/index/404 Not Found");
            die;
        }
    }

    private function profileValidation($id)
    {
        $check = $this -> sessionhandeler();
        if(!$check){
            redirect("/home/signin");
            die;
        }

        $sessid = $_SESSION['userId'];
        if($id == $sessid)
        {
            return 4;
        }else{
            return (new friends) -> checkFriendsStatus($sessid,$id);
        }
    }

}