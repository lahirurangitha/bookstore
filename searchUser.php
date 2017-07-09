<?php
require_once 'core/init.php';

$str = Input::get('q');
$user = new User();
$users = $user->getUserByStr($str);
echo json_encode($users);
