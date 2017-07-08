<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php'?>
<body>

<?php include_once 'includes/navigation.php' ?>

<div class="content">
        <?php
        if(Input::exists()){
            if(Token::check(Input::get('token'))) {
                $validate = new Validation();
                $validation = $validate->check($_POST, array(
                    'username' => array(
                        'required' => true
                    ),
                    'fname' => array(
                        'required' => true
                    ),
                    'lname' => array(
                        'required' => true
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
                    try{
                        $user->update(array(
                            'username' => Input::get('username'),
                            'fname' => Input::get('fname'),
                            'lname' => Input::get('lname'),
                            'password' => Hash::make(Input::get('password')),
                            'token' => Hash::make(Input::get('username').Input::get('password'))
                        ),$user->id);

                        Session::put('messages','Profile updated successfully.');
                        Session::put('m_type','success');
                        Redirect::to('login.php');
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

        <div class="form_background col-5 col-3-offset">
            <form action="" method="post">
                <div class="panel_heading">
                    <h3><strong>Update</strong></h3>
                </div>

                <div class="">
                    <label>Username</label><br>
                    <input class="input_text" type="text" name="username"  value="<?php echo escape($user->username); ?>">
                </div>
                <div class="">
                    <label>First Name</label><br>
                    <input class="input_text" type="text" name="fname"  value="<?php echo escape($user->fname); ?>">
                </div>
                <div class="">
                    <label>Last name</label><br>
                    <input class="input_text" type="text" name="lname"  value="<?php echo escape($user->lname); ?>">
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
                <input class="input_submit"  type="submit" value="Update">
            </form>

        </div>

</div>
<?php include_once 'includes/footer.php'?>

</body>
</html>
