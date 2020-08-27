<?php 

class Input{
    public static function exists($type='post')
    {
        if($type==='post'){
            return (!empty($_POST)) ? true : false;
        }
        else if($type==='get')
        {
            return (!empty($_GET)) ? true : false;
        }
        return '';
    }
    public static function get($data)
    {
        if(isset($_POST[$data])) return $_POST[$data];
        else if(isset($_GET[$data])) return $_GET[$data];
        return '';
    }
}














