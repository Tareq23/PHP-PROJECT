<?php

session_start();
$GLOBALS['config'] = array(
    'mysql' => array(

        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' =>'blood_bank'

    ),
    'session' => array(

        'session_name' => 'user',
        'token_name' => 'token'

    )
);
spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});







