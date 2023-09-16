<?php 
namespace Mvc\Portfolio\models;

use \Exception;
use Mvc\Portfolio\core\registry;


    class Likes extends AbstractModel{
        public $table = 'likes';

        public function getCountLikes($project)
        {
            return registry::get('dbconn')->select($this->table)->where('project')->preparedExecute([$project])->numRows();;
        }

        public function checkLikes($user,$project)
        {
            return registry::get('dbconn')->select($this->table)->where('project')->and('user')->preparedExecute([$project,$user])->numRows();;
        }
        
        public function getAllLikes($project)
        {
            try{
                $likes = registry::get('dbconn')->select($this->table)->where('project')->preparedExecute([$project])->getAll();
                if(!empty($likes)){
                    $newlikes = [];
                    foreach($likes as $like){
                        $like['user']   = (new Users())-> getMainUserData(['id' => $like['user']],['id','name','job','avatar']);
                        $newlikes[] = $like;
                    }
                    return $newlikes;
                }
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
        
        public function addLikes($user,$projec)
        {
            return $this->add($this->table,['user'=>$user,'project'=>$projec]);
        }
        
        public function delLikes($user,$projec)
        {
           return registry::get('dbconn')->delete($this->table)->where('user')->and('project')->preparedExecute([$user,$projec]);
        }

    }