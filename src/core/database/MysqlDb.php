<?php 
namespace Mvc\Portfolio\core\database;

use Mvc\Portfolio\core\database\AbstractDb;
    use \Exception;

    class MysqlDb extends AbstractDb{
        public $conn;
        public $query_result;

        function __construct($dbname)
        {
            $this->connect('localhost','root','',$dbname);
        }

        public function connect($server,$user,$password,$dbname)
        {
            try{
                $this -> conn = mysqli_connect($server,$user,$password,$dbname);
            }catch(Exception $e){
                throw new Exception($e-> getMessage());
            }
        }
           

// EXECUTE STMT

        public function preparedExecute(array $param,string $bind = '')
        {
            if( strlen($bind) != count($param)){
                throw new Exception("The number of variables must match the number of parameters in the prepared statement");
            }
            try{
                $stmt = mysqli_prepare($this->conn,$this->query);
                mysqli_stmt_bind_param($stmt,$bind,...$param);
                mysqli_stmt_execute($stmt);
                $this -> query_result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }catch(Exception $e){
                throw new Exception($e -> getMessage());
            }
            return $this ;
        }
// EXECUTE QUERY

        public function normalExecute()
        {
            $this -> query_result = mysqli_query($this->conn,$this->query);
            if(mysqli_errno($this -> conn)){
                throw new Exception(mysqli_errno($this -> conn));
            }
            return $this ;
        }

// GET SINGLE ROW

        public function getRow()
        {
            $single_data =  mysqli_fetch_assoc($this->query_result);
            $this -> freeResults();
            return $single_data;
        }
        
        
// GET MULTIBLE ROWS

        public function getAll()
        {
            $alldata = [];
            while($single_data =  mysqli_fetch_assoc($this->query_result))
            {
                $alldata[] = $single_data;
            }
            $this -> freeResults();
            return $alldata;
        }
        
// rows count
        public function numRows()
        {
            return mysqli_num_rows($this->query_result);
        }
// GET last inserted id

        public function getLastId()
        {
            return mysqli_insert_id($this->conn);
        }

// free results

        public function freeResults()
        {
            mysqli_free_result($this->query_result);
        }

// close connection

        public function closeConn()
        {
            mysqli_close($this->conn);
        }

        public function __destruct()
        {
            $this->closeConn();
        }


    }