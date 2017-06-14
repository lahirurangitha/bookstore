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
                $str .= '\n';
            }
            echo '<script type="text/javascript">alert("' . $str . '")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php' ?>

<body>
<?php include_once 'includes/navigation.php' ?>

<div class="col-md-4 col-md-offset-4 jumbotron">
<form action="" method="post">
    <div class="form-group">
        <h3 class="text-center"><strong>Register</strong></h3>
    </div>

    <div class="form-group">
        <label>Email</label><br>
        <input class="form-control" type="username" name="username"  placeholder="Enter your username">
    </div>
    <div class="form-group">
        <label>Password</label><br>
        <input class="form-control" type="password" name="password" placeholder="Enter password">
    </div>
    <div class="form-group">
        <label>Re-Password</label><br>
        <input class="form-control" type="password" name="re-password" placeholder="Enter password">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input class="form-control btn-success" type="submit" value="Register">
</form>
    <hr>
    <a href="login.php" style="text-decoration: none"><button class="form-control btn-primary">Login</button></a>
</div>


<?php include_once 'includes/footer.php' ?>
</body>

</html>