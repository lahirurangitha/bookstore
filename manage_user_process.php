<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

$user_id = $_GET['id'];
$set = $_GET['set'];
$m_db = DB::getInstance();
$sql = 'UPDATE user SET active = ? WHERE id = ?';
$m_db->query($sql,array($set,$user_id));

Redirect::to('manage_users.php');
