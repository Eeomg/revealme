<?php 
namespace Mvc\Portfolio\models;

use \Exception;
use Mvc\Portfolio\core\registry;


    class Comment extends AbstractModel{
        public $table = 'comments';

        public function getCountComments($project)
        {
            return registry::get('dbconn')->select($this->table)->where('project')->preparedExecute([$project])->numRows();;
        }


        
        public function getAllComments($project)
        {
            try{
                $comments = registry::get('dbconn')->select($this->table)->where('project')->preparedExecute([$project])->getAll();
                if(!empty($comments)){
                    $newcomments = [];
                    foreach($comments as $comment){
                        $comment['user']   = (new Users())-> getMainUserData(['id' => $comment['user']],['id','name','job','avatar']);
                        $newcomments[] = $comment;
                    }
                    return $newcomments;
                }
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
        
        public function addComment($user,$comment,$projec)
        {
            $this->add($this->table,['user'=>$user,'comment'=>$comment,'project'=>$projec]);
            return registry::get('dbconn')->getLastId();
        }

        private function checkUserComment($user,$commentid)
        {
            return registry::get('dbconn')->select($this->table)->where('id')->and('user')->preparedExecute([$commentid,$user])->numRows();
        }

        public function delComments($user,$commentid)
        {
            return ($this->checkUserComment($user,$commentid)) ? $this->delete($this->table,'id', $commentid) : false;
        }

    }