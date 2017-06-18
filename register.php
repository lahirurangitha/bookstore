<?php

require_once 'core/init.php';

include_once 'auth.php';
if ($user->isLoggedIn()) {
    if($user->isAdmin()){
        Redirect::to('admin_dashboard.php');
    }else {
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
            //register user
            $user = new User();
            try{
                $user->create(array(
                     'username' => Input::get('username'),
                     'password' => Hash::make(Input::get('password')),
                     'token' => Hash::make(Input::get('username').Input::get('password'))
                    ));

                Session::put('messages','Account created successfully');
                Session::put('m_type','success');
                Redirect::to('index.php');
            }catch (Exception $e){
                die($e->getMessage());
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
                <h3><strong>Register</strong></h3>
            </div>

            <div class="">
                <label>Username</label><br>
                <input class="input_text" type="username" name="username"  placeholder="Enter your username">
            </div>
            <div class="">
                <label>Password</label><br>
                <input class="input_text" type="password" name="password" placeholder="Enter password">
            </div>
            <div class="">
                <label>Re-Password</label><br>
                <input class="input_text" type="password" name="re-password" placeholder="Enter password">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate();?>">
            <input class="input_submit" type="submit" value="Register">
        </form>
        <hr>
        <a href="login.php"><button class="input_link">Login</button></a>
    </div>
</div>


<?php include_once 'includes/footer.php' ?>
</body>

</html>