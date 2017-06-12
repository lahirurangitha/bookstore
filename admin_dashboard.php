<?php
require_once 'core/init.php';

if(Session::exists('user')){
    $user = new User();
    $u_data = json_decode(Session::get('user'),true);
    if(!$user->auth($u_data['username'],$u_data['token'])){
        session_destroy();
        Redirect::to('login.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php'?>
<body>

<?php include_once 'includes/navigation.php'?>

<div class="container">
    <div class="row">
        admin
    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
