<?php

require_once 'init/init.php';

Class DB{

    private static $_connect = null;
    private $_pdo,$_error=false,$_count=0,$_result,$_query;

    public function __construct()
    {
        try{
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/dbname'),Config::get('mysql/username'),Config::get('mysql/password'));
            //  echo 'Success!';
        }
        catch(PDOException $e)
        {
            echo "Could not connect";
            die($e->getMessage());
        }
        
    }
    public static function connect(){
        if(!isset(self::$_connect))
        {
            self::$_connect = new DB();
        }
        return self::$_connect;
    }
    public function query($sql,$params = array())
    {
        $this->_error =false ;
        // die();
        if($this->_query = $this->_pdo->prepare($sql))
        {
            if(count($params)){
                 var_dump($params);
                // ();die
                $idx = 1;
                foreach($params as $value)
                {
                    echo $value."<br>";
                    $this->_query->bindValue($idx,$value);
                    $idx++;
                }
                if($this->_query->execute()){
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }
                else{
                   
                    $this->_error = true;
                }
            }
            else{
                // echo $sql."<br>";
                if($this->_query->execute())
                {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }
                else{
                    $this->_error = true;
                }
            }
        }
        return $this;
    }
    public function error()
    {
        return $this->_error;
    }

    public function insert($table,$fields = array())
    {
        if(count($fields)){
            $keys = array_keys($fields);
            $keys = implode(',',$keys);
            $value = '';
            $cnt = 1;
            foreach($fields as $field)
            {
                $value .= '?';
                if($cnt<count($fields))
                {
                    $value .=',';
                }
                $cnt++;
            }
            $sql = "INSERT INTO {$table}({$keys})VALUES({$value})";
            if(!$this->query($sql,$fields)){
                return true;
            }
        }
        return false;
    }
    
    public function update($table,$id,$fields=array()){
        if(count($fields)){
            //$keys = array_keys($fields);

            $value = '';
            $cnt=1;
            foreach($fields as $key => $field)
            {
                $value .= "{$key} = ?";
                if($cnt<count($fields))
                {
                    $value .= ',';
                }
            }

            $sql = "UPDATE {$table} SET {$value} WHERE id = {$id}";
            if(!$this->query($sql,$fields)){
                return true;
            }
        }
    }
    public function result()
    {
        return $this->_result;
    }
    public  function get($table,$fields = array())
    {
        if(count($fields)==3)
        {
            $operators = array('=','>=','<=','>','<');
            $field = $fields[0];
            $operator = $fields[1];
            $value = $fields[2];
            if(in_array($operator,$operators)){
                $sql = "SELECT * FROM {$table} WHERE {$field} {$operator} ? ";
                if(!$this->query($sql,array($value)->error()))
                {
                    return $this->result();
                }
            }   
        }
        return false;
    }
    public function count()
    {
        return $this->_count;
    }
    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        if(!$this->query($sql)->error){
            return $this->result();
        }
    }
}













