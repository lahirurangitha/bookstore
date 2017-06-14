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
        if(!$this->_db->insert('user',$fields)){
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

    public function isAdmin(){
        return ($this->role == 1);
    }

    private function init(){
        foreach ($this->_data[0] as $key => $value){
            $this->{$key} = $value;
        }
    }
    public function toString(){
        return json_encode(['id'=>$this->id,'username'=>$this->username,'role'=>$this->role,'token'=>$this->token]);
    }

    public function login($username, $password){
        $this->_db->query('SELECT * FROM user WHERE username = ? AND password = ?', array($username, Hash::make($password)));
        $this->_data = $this->_db->results();
        if ($this->_db->count()) {
            $this->init();
            $this->_isLoggedIn = true;
            return 1;
        }
        return 0;
    }

    public function auth($username, $token){
        $this->_db->query('SELECT * FROM user WHERE username = ? AND token = ? AND active = 1', array($username, $token));
        $this->_data = $this->_db->results();
        if ($this->_db->count()) {
            $this->init();
            $this->_isLoggedIn = true;
            return 1;
        }
        return 0;
    }

    public function getUsers()
    {
        $users = array();
        $this->_db->query('SELECT * FROM user WHERE role = ? ' , array(2));
        foreach ($this->_db->results() as $u){
            $users[] = $u;
        }
        return $users;
    }

}