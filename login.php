<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 2/19/2016
 * Time: 11:48 AM
 */

require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )
        ));
        if ($validation->passed()) {
            //login user
            $email = $_POST['email'];
            $password = $_POST['password'];
            $loginCheck = DB::getInstance();
            $loginCheck->query('SELECT * FROM user_detail WHERE email = ? AND Password = ?', array($email, $password));
            if ($loginCheck->count()) {
                echo 'User exists.';
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
<form action="" method="post">
    <div>
        <h3 id="signin"><strong>Sign In</strong></h3>
    </div>

    <div>
        <label>Email</label><br>
        <input name="email"  placeholder="Enter your e-mail">
    </div>
    <div>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Enter password">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="Sign In">
</form>
