<?php
namespace Mvc\Portfolio\core\database;

    abstract class AbstractDb{
        public $query;
        
        public $table;
 
        abstract protected function connect($server,$user,$password,$dbname);

        // SELECT

        public function select($table ,array $data =['*'])
        {
            $columns = "";
            $columns = implode(",",$data);
            $this -> query = "SELECT $columns from {$table} ";
            return $this;
        }

        // INSERT

        public function insert($table , array $data)
        {
            $columns = "";
            $columns = implode(" = ? ,",$data);
            $this -> query = "INSERT INTO {$table} SET $columns = ? ";
            return $this;
        }

        // UPDATE

        public function update($table , array $data)
        {
            $columns = "";
            $columns = implode(" = ? ,",$data);
            $this -> query = "UPDATE {$table} set $columns = ?  ";
            return $this;
        }

        // DELETE

        public function delete($table)
        {
            $this -> query = "DELETE FROM {$table} ";
            return $this;
        }
                
        // WHERE
        public function where($colum,$sign = '=',string $value = '?')
        {
            if($value == '?'){
                $this -> query .= " WHERE $colum $sign $value ";
            }else{
                $this -> query .= " WHERE $colum $sign '$value' ";
            }
            return $this;
        }
                
        // AND
        public function and($colum,$sign = '=',$value = '?')
        {
            $this -> query .= " AND $colum $sign $value ";
            return $this;
        }

        // OR
        public function or($colum,$sign,$value = '?')
        {
            $this -> query .= " OR $colum $sign $value ";
            return $this;
        }
                
        // OR
        public function like($colum,$value = '?')
        {
            $this -> query .= " WHERE $colum LIKE $value ";
            return $this;
        }
                
        // JOIN
        public function join($jtable,$jcolumn,$ptable,$pcolumn)
        {
            $this->query .= " left JOIN $jtable ON $ptable.$pcolumn = $jtable.$jcolumn ";
            return $this;
        }

        // ORDER BY
        public function orderBy($colum,$value = '')
        {
            $this -> query .= " ORDER BY $colum $value ";
            return $this;
        }

        // GROUP BY
        public function groupBy($colum)
        {
            $this -> query .= " GROUP BY $colum ";
            return $this;
        }

        // HAVING
        public function having($colum,$sign,$value = '?')
        {
            $this -> query .= " HAVING $colum $sign $value";
            return $this;
        }
        // LIMIT
        
        public function limit( $value )
        {
            $this -> query .= " LIMIT $value ";
            return $this;
        }
        
        // OFFSET
        public function offset( $value )
        {
            $this -> query .= " OFFSET $value ";
            return $this;
        }
        
        // BETWEEN
        public function whereBetween( $column,$f_value,$s_value )
        {
            $this -> query .= " WHERE $column BETWEEN $f_value AND $s_value ";
            return $this;
        }

        
        abstract public function preparedExecute(array $param,string $bind = '');

        abstract public function normalExecute();
        
        abstract public function numRows();

        abstract public function getRow();

        abstract public function getAll();
    }