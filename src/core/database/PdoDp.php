<?php
namespace Mvc\Portfolio\core\database;

use Mvc\Portfolio\core\database\AbstractDb;


    use \Exception;
    use \PDO;
    
    class PdoDp extends AbstractDb{

        public $conn;
        public $query_result;

        public function __construct($dbname)
        {
            $this -> connect('localhost','root','',$dbname);
        }


        protected function connect($server,$user,$password,$dbname)
        {
            $dsn = "mysql:host=$server;dbname=$dbname;charset=utf8";
            try{
                $this -> conn = new PDO($dsn,$user,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }


        public function preparedExecute(array $param,string $bind = '')
        {
            try{
                $this -> query_result = $this -> conn -> prepare($this->query);
                $count = count($param);
                for($i = 0 ; $i < $count ;$i++){
                    $this -> query_result -> bindParam($i+1,$param[$i]);
                }
                $this -> query_result -> execute();
                if($this->query_result->errorCode() !== '00000'){
                    throw new Exception("Error Code : ".$this -> query_result -> errorCode());
                }
            }catch(Exception $e){
                throw new Exception($e -> getMessage());
            }
            return $this;
        }

        public function normalExecute()
        {
            try{
                $this -> query_result = $this -> conn -> prepare($this->query);
                $this -> query_result -> execute();
                if(!$this->query_result->errorCode() === '00000'){
                    throw new Exception("Error Code : ".$this -> query_result -> errorCode());
                }
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
            return $this;
        }
        
        public function numRows()
        {
               return $this -> query_result -> rowCount();
        }

        public function getLastId()
        {
            return $this->conn->lastInsertId();
        }


        public function getRow()
        {
            $data = $this -> query_result -> fetch(PDO::FETCH_ASSOC);
            return (!empty($data)) ? $data : false ;
        }
        
        public function getAll()
        {
            $data = $this -> query_result -> fetchAll(PDO::FETCH_ASSOC);
            return (!empty($data)) ? $data : false ;
        }

    }