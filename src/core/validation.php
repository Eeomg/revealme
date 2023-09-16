<?php 
    namespace Mvc\Portfolio\core;

    use \Exception;

    class validation extends Exception {

        private $key;
        private $value;

        public function setValue(array $data)
        {
            $key = array_keys($data); 
            $this -> value = $data[$key[0]];
            $this -> key = $key[0];
            return $this;
        }

        public function fInteger()
        {
            $this -> value = filter_var(trim($this->value),FILTER_SANITIZE_NUMBER_INT); 
            $this -> notEmpty();
            return $this;
        }

        public function fEmail()
        {
            $this -> value = filter_var(trim($this->value),FILTER_VALIDATE_EMAIL); 
            $this -> value = filter_var(trim($this->value),FILTER_SANITIZE_SPECIAL_CHARS);
            $this -> notEmpty();
            return $this;
        }

        public function fString()
        {
            $this -> value = filter_var(trim($this->value),FILTER_SANITIZE_SPECIAL_CHARS);
            $this -> notEmpty();
            return $this; 
        }

        public function fImage()
        {
            $img = $this -> value;
            if(!empty($img['name']) ){
                if( $img['error'] == 0 ){
                    $ava_ext = ['jpg','png','jfif','gif'];
                    $img_ext = pathinfo($img['name'],PATHINFO_EXTENSION);
                    if(in_array($img_ext,$ava_ext)){
                        if($img['size'] <= 2000000){
                            $this -> value = md5(uniqid()).".webp"; 
                            move_uploaded_file($img['tmp_name'],"D:\\xampp\htdocs\\revealme v(2)\public\admin\dist\img\\{$this -> value}");
                        }else{ 
                            throw new Exception($this -> key." size is big try another one");
                         }
                    }else{
                        throw new Exception($this -> key." extention is not valid");
                     }
                }else{ 
                    throw new Exception($this -> key." is not uploaded");
                }
            }else{
                $this -> value = false;
            }
            return $this;
        }

        public function fPassword()
        {
            $this -> notEmpty();
            return $this;
        }

        public function hash(){
            $this-> value = password_hash($this->value,PASSWORD_DEFAULT);
            return $this;
        }

        public function notEmpty()
        {
            if(empty($this->value)){
                throw new Exception($this -> key.' is not valid');
            }
        }

        public function min($length)
        {           
            if(strlen($this-> value) < $length)
            {
                throw new Exception($this->key.' must not be less than '.$length);
            }

            return $this;
        }

        public function max($length)
        {
            if(strlen($this-> value) > $length)
            {
                throw new Exception($this->key.' must not be more than '.$length);
            }
            return $this;
        }

        public function getValue()
        {
            return $this -> value;
        }
    }

?>