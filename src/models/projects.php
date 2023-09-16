<?php 

    namespace Mvc\Portfolio\models;
    use Exception;
    use Mvc\Portfolio\core\registry;

    class Projects extends AbstractModel{
        public $table = 'projects';

        public function getFriendsProjects($user)
        {
            try{
                $projects = registry::get('dbconn')->select($this->table,[$this->table.'.*','friends.*'])->join('friends','friend',$this->table,'user_id')->groupBy('id')->having('user_id','=')->or('user','=')->and('confirm','=')->preparedExecute([$user,$user,1])->getAll();
                $newprojects = [];
                if($projects){
                    foreach($projects as $project){
                        $project['user']     = (new Users()) -> getMainUserData(['id' => $project['user_id']],['id','name','job','avatar']);
                        $project['comments'] = (new comment()) -> getAllComments($project['id']);
                        $project['likes']    = (new Likes()) -> getAllLikes($project['id']);
                        
                        $project['commentscount'] = (new comment()) -> getCountComments($project['id']);
                        $project['likescount']    = (new Likes()) -> getCountLikes($project['id']);
                        $newprojects[] = $project;
                    }
                }
                return $newprojects;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
        
        public function getFriendsProjectsCount($user)
        {
            try{
                return registry::get('dbconn')->select($this->table,[$this->table.'.*','friends.*'])->join('friends','friend',$this->table,'user_id')->groupBy('id')->having('user','=')->or('user_id','=')->preparedExecute([$user,$user])->numRows();
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }


        public function getUserProjects($user)
        {
            try{
                $projects = registry::get('dbconn')->select($this->table)->where('user_id')->preparedExecute([$user])->getAll();

                $newprojects = [];
                if($projects){
                    foreach($projects as $project){
                        $project['user']     = (new Users()) -> getMainUserData(['id' => $project['user_id']],['id','name','job','avatar']);
                        $project['comments'] = (new comment()) -> getAllComments($project['id']);
                        $project['likes']    = (new Likes()) -> getAllLikes($project['id']);
                        
                        $project['commentscount'] = (new comment()) -> getCountComments($project['id']);
                        $project['likescount']    = (new Likes()) -> getCountLikes($project['id']);
                        $newprojects[] = $project;
                    }
                }

                return $newprojects;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        } 

        public function getUserProjectsCount($user)
        {
            try{
                return registry::get('dbconn')->select($this->table)->where('user_id')->preparedExecute([$user])->numRows();
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function checkProject($user,$project)
        {
            try{
                return registry::get('dbconn')->select($this->table)->where('id')->and('user_id')->preparedExecute([$project,$user])->numRows();
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function addProject($userid,$disc)
        {
            $addproject = $this->add($this->table,['disc'=>$disc,'user_id'=>$userid]);
            return $addproject;
        }
        
        public function delProject($user,$projectid)
        {
            return ($this->checkProject($user,$projectid)) ? $this->delete($this->table,'id',$projectid) : "";
        }
        
        

    }