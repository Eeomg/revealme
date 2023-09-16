<?php 


namespace Mvc\Portfolio\controllers;


use Exception;
    use Mvc\Portfolio\models\users;
    use Mvc\Portfolio\core\session;
    use Mvc\Portfolio\core\registry;
    use Mvc\Portfolio\controllers\AbstractController;

    class Auth extends AbstractController{

        public function signIn()
        {
            $check = $this -> sessionhandeler();
            if($check){
                redirect("/home/signin");
                die;
            }
            $valid = registry::get("validation");
            try{
                $email    = $valid->setValue(['email'=>$_POST['email']])->fEmail()->getValue();
                $password = $valid->setValue(['password'=>$_POST['password']])->fPassword()->getValue();

                $data     = (new users) -> getMainUserData(['email' => $email]);

                if($data){
                    if(password_verify($password,$data['password'])){
                        session_start();
                        $_SESSION['userId'] = $data['id'];
                        $_SESSION['userName'] = $data['name'];
                        $_SESSION['userEmail'] = $data['email'];
                        $_SESSION['userAvatar'] = $data['avatar'];
                        redirect("/");
                    }else{
                        $_SESSION['error'] = "email or password are not valid";
                    }
                }else{
                    $_SESSION['error'] = "email or password are not valid";
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
            redirect("/Home/signIn");
        }

        public function signUp()
        {
            $check = $this -> sessionhandeler();
            if($check){
                redirect("/");
                die;
            }
            $valid = registry::get("validation");
            try{
                $name  = $valid->setValue(['name' =>$_POST['name']])->fString()->min(5)->max(30)->getValue();
                $email = $valid->setValue(['email'=>$_POST['email']])->fEmail()->getValue();
                $phone = $valid->setValue(['phone'=>$_POST['phone']])->fInteger()->min(11)->max(11)->getValue();
                $job   = $valid->setValue(['job'  =>$_POST['job']])->fString()->getValue();
                if($_POST['password'] == $_POST['rpassword']){
                    $password  = $valid->setValue(['password'=>$_POST['password']])->fPassword()->hash()->getValue();
                    $add = (new users)->addUser(['name'=>$name,'email'=>$email,'phone'=>$phone,'job'=>$job,'password'=>$password]);
                    if($add){
                        redirect("/Home/signin");
                    }else{
                        $_SESSION['error'] = "this user is exist";
                    }
                }else{
                    $_SESSION['error'] = "Retype Your password Correctly";
                }
            }catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
            redirect("/Home/signup");
        }
    }