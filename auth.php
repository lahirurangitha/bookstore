<?php

if (Session::exists('user')) {
    global $user;
    $user = new User();
    $u_data = json_decode(Session::get('user'), true);
    if (!$user->auth($u_data['username'], $u_data['token'])) {
        session_destroy();
        Redirect::to('login.php');
    }
} else {
    $user = new User();
}