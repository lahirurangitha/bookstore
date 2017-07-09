<?php


class Book {

    private $_db,
        $_data,
        $_isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields =array()){
        if(!$this->_db->insert('book',$fields)){
            throw new Exception('There was a problem inserting book.');
        }
    }

    public function update($fields = array(), $id){
        if(!$this->_db->update('book', $id, $fields)) {
            throw new Exception('There was a problem updating..');
            return false;
        }
        return true;
    }

    public  function data(){
        return $this->_data;
    }

    private function init(){
        foreach ($this->_data[0] as $key => $value){
            $this->{$key} = $value;
        }
    }

    public function getById($id){
        $this->_db->get('book',array('id','=',$id));
        $this->_data = $this->_db->results();
        if ($this->_db->count()) {
            $this->init();
            return 1;
        }
        return 0;
    }

    public function getAll()
    {
        $books = array();
        $this->_db->query('SELECT * FROM book' , array());
        foreach ($this->_db->results() as $b){
            $books[] = $b;
        }
        return $books;
    }

    public function getBookByStr($str)
    {
        $books = array();
        $this->_db->query('SELECT * FROM book WHERE name LIKE ?', array("%$str%"));
        $this->_data = $this->_db->results();
        if ($this->_db->count()) {
            foreach ($this->_db->results() as $b) {
                $books[] = $b;
            }
        }
        return $books;
    }

}