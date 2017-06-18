<?php
require_once 'core/init.php';

include_once 'auth.php';

$upload_dir = Config::get('upload_dir');
if(is_dir($upload_dir)==false){
    mkdir("$upload_dir", 0700);		// Create directory if it does not exist
}
if(isset($_FILES['books'])){
    $errors= array();
    foreach($_FILES['books']['tmp_name'] as $key => $tmp_name ){
        $file_name = $_FILES['books']['name'][$key];
        $file_size =$_FILES['books']['size'][$key];
        $file_tmp =$_FILES['books']['tmp_name'][$key];
        $file_type=$_FILES['books']['type'][$key];

        $sql="INSERT into book (name,created_by,location) VALUES (?,?,?)";
        $upload_db = DB::getInstance();

        if(empty($errors)==true){
            if(!file_exists("$upload_dir/".$file_name)){
                move_uploaded_file($file_tmp,$upload_dir."/".$file_name);
                $location = $upload_dir."/".$file_name;
            }else{									//rename the file if another one exist
                rename($file_tmp,$upload_dir."/".$file_name.time()) ;
                $location = $upload_dir."/".$file_name.time();
            }
            $upload_db->query($sql,array($file_name,$user->id,$location));
        }else{
            print_r($errors);
        }
    }
    if(empty($error)){
        Session::put('messages','Successfully uploaded.');
        Session::put('m_type', 'success');
    }else{
        Session::put('messages','Failed to upload.');
        Session::put('m_type', 'error');
    }

    Redirect::to('admin_dashboard.php');
}