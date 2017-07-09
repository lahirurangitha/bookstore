<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'auth.php'?>
<?php include_once 'includes/header.php'?>

<body>

<?php include_once 'includes/navigation.php'?>

<div class="content">
    <?php
    if(!$user->isLoggedIn()){
        ?>
        <div class="col-5 col-4-offset">
            <strong style="font-size: 75px" class="col-1-offset">Welcome</strong><br>
            <img src="styles/img/logo.png"><br>

            <h3 class="col-1-offset">Please Log In OR Register to Continue</h3>

        </div>
    <?php

    }else{
        Redirect::to('user_dashboard.php');
    }
    ?>



</div>

<?php include_once 'includes/footer.php'?>
</body>

</html>
