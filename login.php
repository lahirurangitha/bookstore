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
}else{
    $user  = new User();
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )
        ));
        if ($validation->passed()) {
            //login user
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = new User();
            if ($user->login($username, $password)) {
                Session::put('user',$user->toString());
                if($user->role==1){
                    Redirect::to('admin_dashboard.php');
                }else{
                    Redirect::to('user_dashboard.php');
                }
            } else {
                echo 'Credentials does not match.';
            }
            //
        } else {
            $str = "";
            foreach ($validate->errors() as $error) {
                $str .= $error;
                $str .= '\n';
            }
            echo '<script type="text/javascript">alert("' . $str . '")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php'?>

<body>

<?php include_once 'includes/navigation.php'?>
<form action="" method="post">
    <div>
        <h3 id="signin"><strong>Sign In</strong></h3>
    </div>

    <div>
        <label>Email</label><br>
        <input name="username"  placeholder="Enter your username">
    </div>
    <div>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Enter password">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="Sign In">
</form>


<?php include_once 'includes/footer.php'?>
</body>

</html>

