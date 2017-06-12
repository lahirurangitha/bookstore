<?php

require_once 'core/init.php';

if(Session::exists('user')){
    $user = new User();
    $u_data = json_decode(Session::get('user'),true);
    if(!$user->auth($u_data['username'],$u_data['token'])){
        session_destroy();
        Redirect::to('login.php');
    }
    if($u_data['role']==1){
        Redirect::to('admin_dashboard.php');
    }else{
        Redirect::to('user_dashboard.php');
    }
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'unique' => 'user' //table name
            ),
            'password' => array(
                'required' => true
            ),
            're-password' => array(
                'required' => true,
                'matches' => 'password'
            )
        ));
        if ($validation->passed()) {
            echo 'passed';
            //register user
            $user = new User();
            try{
                $user->create(array(
                     'username' => Input::get('username'),
                     'password' => Hash::make(Input::get('password')),
                     'token' => Hash::make(Input::get('username').Input::get('password'))
                    ));

                echo 'registration successful';
                Redirect::to('index.php');
            }catch (Exception $e){
                die($e->getMessage());
            }
            //
        } else {
            $str = "";
            foreach ($validate->errors() as $error) {
                $str .= $error;
                $str .= '<br>';
                //            $str .= '\n';
            }
            echo $str;
        }
    }
}
?>
<form action="" method="post">
    <div>
        <h3><strong>Sign up</strong></h3>
    </div>

    <div>
        <label>Email</label><br>
        <input type="username" name="username"  placeholder="Enter your username">
    </div>
    <div>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Enter password">
    </div>
    <div>
        <label>Re-Password</label><br>
        <input type="password" name="re-password" placeholder="Enter password">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="Register">
</form>