<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
if ($user->isAdmin()) {
    Redirect::to('login.php');
}

$id = $_GET['id'];

$book = new Book();
$book->getById($id);
if(count($book->data())==0){
    Session::put('messages','Book not found.');
    Session::put('m_type','error');
}else{
    if($book->count==0){
        Session::put('messages','Failed to download. No Available copies found.');
        Session::put('m_type','error');
    }else{
        $db = DB::getInstance();
        $db->query('SELECT * FROM users_books WHERE user_id = ? AND book_id =  ?',array($user->id,$book->id));
        if($db->count()>0){
            Session::put('messages','You have already downloaded this book.');
            Session::put('m_type','error');
        }else{
            $update = $book->update(array('count' => $book->count -1,'download_count' => $book->download_count+1),$id);
            $db->insert('users_books',array('user_id'=>$user->id,'book_id'=>$book->id));
            Session::put('messages','Book downloaded successfully');
            Session::put('m_type','success');
        }
    }
}

Redirect::to('books.php');

?>