<?php

require_once 'core/init.php';

include_once 'auth.php';
if ($user->isLoggedIn()) {
    if ($user->isAdmin()) {
        Redirect::to('admin_dashboard.php');
    } else {
        Redirect::to('user_dashboard.php');
    }

}


if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
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
                if(!$user->active){
                    Session::put('messages','Your Account is deactivated by Administrator');
                    Session::put('m_type','error');
                    Redirect::to('login.php');
                }
                Session::put('user', $user->toString());
                if ($user->role == 1) {
                    Redirect::to('admin_dashboard.php');
                } else {
                    Redirect::to('user_dashboard.php');
                }
            } else {
                Session::put('messages','Credentials does not match.');
                Session::put('m_type','error');
            }
            //
        } else {
            $str = "";
            foreach ($validate->errors() as $error) {
                $str .= ucfirst($error);
                $str .= '<br>';
            }
            Session::put('messages',$str);
            Session::put('m_type','error');
            Redirect::to('login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php' ?>

<body>

<?php include_once 'includes/navigation.php' ?>
<div class="content">
    <div class="form_background col-5 col-3-offset">
        <form action="" method="post">
            <div class="panel_heading">
                <h3><strong>Login</strong></h3>
            </div>

            <div class="">
                <label>Username</label><br>
                <input class="input_text" name="username" placeholder="Enter your username">
            </div>
            <div class="">
                <label>Password</label><br>
                <input class="input_text" type="password" name="password" placeholder="Enter password">
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="input_submit" type="submit" value="Sign In">
        </form>
        <hr>
        <a href="register.php"><button class="input_link">Register</button></a>
    </div>
</div>

<?php include_once 'includes/footer.php' ?>
</body>

</html>

