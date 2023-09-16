<?php 
namespace Mvc\Portfolio\models;

use Exception;
use Mvc\Portfolio\core\registry;


    abstract class AbstractModel{
        
        public function edit($table,array $data,array $reference)
        {
            $keys = array_keys($data);
            $values = array_values($data);
            $refer =  array_keys($reference)[0];
            $values[] = $reference[$refer];

            try{
                registry::get('dbconn')->update($table,$keys)->where($refer)->preparedExecute($values);
                return true;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function add($table,array $data)
        {
            $keys = array_keys($data);
            $values = array_values($data);
            try{
                registry::get('dbconn')->insert($table,$keys)->preparedExecute($values);
                return true;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }

        public function delete($table,$key,$value)
        {
            try{
                registry::get('dbconn')->delete($table)->where($key)->preparedExecute([$value]);
                return true;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
    }