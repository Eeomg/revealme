<?php 

    namespace Mvc\Portfolio\models;
    use Exception;
    use Mvc\Portfolio\core\registry;
    use Mvc\Portfolio\models\Social;

    class Users extends AbstractModel{

        public $table = 'users';

        public function getMainUserData(array $data,array $column = ['*'])
        {
            try{
                $key = array_keys($data)[0]; 
                $data = registry::get('dbconn')->select($this->table,$column)->where($key)->limit(1)->preparedExecute([$data[$key]])->getRow();
                return $data;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
        public function getAllUserData(array $data)
        {
            $key = array_keys($data)[0];
            try{
                $data = registry::get('dbconn')->select($this->table)->where($key)->limit(1)->preparedExecute([$data[$key]])->getRow();
                if($data){
                    $data['posts']  = (new projects) -> getUserProjects($data[$key]);
                    $data['project_count']  = (new projects) -> getUserProjectsCount($data[$key]);
                    $data['friends'] = (new friends) -> userFriends($data[$key]);
                }
                return $data;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function checkUser($email)
        {
            return registry::get('dbconn')->select($this->table)->where('email')->limit(1)->preparedExecute([$email])->numRows();
        }


        public function addUser(array $data)
        {
            $check = $this -> checkUser($data['email']);
            if(!$check){
              $this->add($this->table,$data) ;
              return true;
            }
            return false;
        }

        public function editMainData($name,$email,$phone,$job,$password,$image,$id)
        {
            if($image == ''){
                return $this->edit($this->table,['name'=>$name,'email'=>$email,'phone'=>$phone,'job'=>$job,'password'=>$password],['id'=>$id]);
            }
            return $this->edit($this->table,['name'=>$name,'email'=>$email,'phone'=>$phone,'job'=>$job,'password'=>$password,'avatar'=>$image],['id'=>$id]);
        }

        public function editAvatar($image,$id)
        {
            return $this->edit($this->table,['avatar'=>$image],['id'=>$id]);
        }

        public function editEduc($educ,$id)
        {
            return $this->edit($this->table,['educ'=>$educ],['id'=>$id]);
        }

        public function editDisc($disc,$id)
        {
            return $this->edit($this->table,['disc'=>$disc],['id'=>$id]);
        }


        
    }