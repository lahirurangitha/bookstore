<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

$book_id = $_GET['id'];
$b_db = DB::getInstance();
$sql = 'DELETE FROM book WHERE id = ?';
$b_db->query($sql,array($book_id));
if($b_db->error()){
    Session::put('messages', 'Failed to delete.');
    Session::put('m_type', 'error');
}else{
    Session::put('messages', 'Book deleted successfully');
    Session::put('m_type', 'success');
}

Redirect::to('manage_books.php');
