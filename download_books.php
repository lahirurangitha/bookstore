<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
if ($user->isAdmin()) {
    Redirect::to('login.php');
}

$upload_dir = Config::get('upload_dir');
if(is_dir($upload_dir)==false){
    mkdir("$upload_dir", 0700);		// Create directory if it does not exist
}

$id = $_GET['id'];
$sql  = "SELECT * FROM book WHERE id = ?";
$dwnld_db = DB::getInstance()->query($sql,array($id));
if(!$dwnld_db->count()){
    Session::put('messages','Book not found.');
    Session::put('m_type','error');
//    Redirect::to('user_dashboard.php');
}else{
    $book = $dwnld_db->first();
    $path = $book->location;
    if (file_exists($path) && is_readable($path)) {
        $size = filesize($path);
        header('Content-Type: application/octet-stream');
        header('Content-Length: '.$size);
        header('Content-Disposition: attachment; filename='.$book->name);
        header('Content-Transfer-Encoding: binary');
        $file = @ fopen($path, 'rb');
        if ($file) {
            fpassthru($file);
            exit;
        } else {
            Session::put('messages','Book not found.');
            Session::put('m_type','error');
            Redirect::to('user_dashboard.php');
        }
    } else {
        Session::put('messages','Book not found.');
        Session::put('m_type','error');
        Redirect::to('user_dashboard.php');
    }
}

?>