<?php

class Validate{

    private $_passed = false;
    private $_error = array();
    private $_value = array();
    public function check($req,$input=array())
    {
        /// $req['name'];
        foreach($input as $input_name => $condition)
        {
            if($input_name === 'count'){
                if($req[$input_name]<0)
                {
                    $this->addError("It's impossible");
                    continue;
                }
            }
            foreach($condition as $cond_data => $condition_value)
            {
                // echo $cond_data . "  ". $input_name."\t".$condition_value."<br>";
                if($cond_data==='require' && empty($req[$input_name])){
                    //$this->_error[$input_name]="it's needed";
                    $this->addError("{$input_name} must be required!");

                }else if(!empty($req[$input_name])){
                    $value = $req[$input_name];
                    switch($cond_data)
                    {
                        case 'min':
                            if(strlen($value)<$condition_value)
                            {
                                $this->addError("{$value} must be greater than {$condition_value} characters");
                            }
                        break;
                        case 'max':
                            if(strlen($value)>$condition_value)
                            {
                                $this->addError("{$value} must be less than {$condition_value} characters");
                            }
                        break;
                        case 'fixed':
                            if(strlen($value)==$condition_value)
                            {
                                $this->addError("{$value} must be {$condition_value} digits");
                            }
                        break;
                    }
                }
            }
            if(!empty($this->_error[$input_name]))
            {
                $this->_value[] = $req[$input_name];
            }
        }
        if(empty($this->_error))
        {
            $this->_passed = true;
        }
    }
    
    public function addError($error)
    {
        $this->_error[] = $error;
    }
    public function passed()
    {
        return $this->_passed;
    }
    public function error()
    {
        return $this->_error;
    }
}





