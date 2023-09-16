<?php 
namespace Mvc\Portfolio\models;

use \Exception;
use Mvc\Portfolio\core\registry;


    class friends extends AbstractModel
    {
        public $table = 'friends';

        public function getCountFriends($user)
        {
            return registry::get('dbconn')->select($this->table)->where('user')->and('confirm')->preparedExecute([$user,1])->numRows();;
        }

        public function checkFriendsStatus($user,$friend)
        {
            $status = $this->checkFriend($user,$friend);
            if($status == 3){
                $status = $this->checkFriend($friend,$user); 
                $status = ($status == 0) ? 2 : $status ;
            }
            return $status;
        }

        private function checkFriend($user,$friend)
        {
            try{
                $fetch = registry::get('dbconn')->select($this->table)->where('user')->and('friend')->limit(1)->preparedExecute([$user,$friend]);
                $check = $fetch->numRows(); 
                if($check == 1){
                    $data = $fetch->getRow();
                    return $data['confirm']; 
                }else{
                    return 3;
                }
            }catch(Exception $e){
                throw new Exception($e -> getMessage());
            }
        }
        
        public function userFriends($user)
        {
            try{
                $allfriends = ['confirmed_friends'=> $this->friends('user','friend',$user,1),'waitingfriends' => $this->friends('friend','user',$user,0),'count'=>$this->getCountFriends($user)];
                return $allfriends;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        private function friends($userstate,$friendstate,$value,$confirm)
        {
            $friends = registry::get('dbconn')->select($this->table)->where($userstate)->and('confirm')->preparedExecute([$value,$confirm])->getAll();
            if(!empty($friends)){
                $allfriends = [];
                foreach($friends as $friend){
                    $allfriends[] = (new Users())-> getMainUserData(['id' => $friend[$friendstate]],['id','name','job','avatar']);
                }
                return $allfriends;
            }
        }
        

        public function confirmFriend($user,$friend)
        {
            $check = $this->checkFriendsStatus($friend,$user);
            if($check == 0){
                registry::get('dbconn')->update($this->table,['confirm'])->where('user')->and('friend')->preparedExecute([1,$friend,$user]);
                $this -> addFriend($user,$friend,1);
                return true;
            }
            return false;

        }

        public function addFriend($user,$friend,$confirm = 0)
        {
            return $this->add($this->table,['user'=>$user,'friend'=>$friend,'confirm'=>$confirm]);
        }
        
        public function delFriend($user,$friend,$check)
        {
            if($check == 1)
            {
                registry::get('dbconn')->delete($this->table)->where('user')->and('friend')->preparedExecute([$friend,$user]);
            }
            return registry::get('dbconn')->delete($this->table)->where('user')->and('friend')->preparedExecute([$user,$friend]);
        }
    }