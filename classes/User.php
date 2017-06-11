<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 2/19/2016
 * Time: 11:54 AM
 */

class User{
    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');


    }

    public function create($fields =array()){
        if(!$this->_db->insert('user_detail',$fields)){
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }



    public  function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
}