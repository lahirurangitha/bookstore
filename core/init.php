<?php

session_start();
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'bookstore_db'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 6048000
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    ),
    'upload_dir' => 'store'

);

spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});

require_once 'functions/sanitize.php';