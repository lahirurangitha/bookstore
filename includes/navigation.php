<!-- Navigation -->
<nav class="nav">
    <ul>
        <li><a href="index.php"><img src="styles/img/bookstore-logo.png" height="34px"></a></li>
        <?php
        if($user->isLoggedIn()){
            $user->isAdmin()?$dashboard = 'admin_dashboard.php':$dashboard = 'user_dashboard.php';
            ?>
            <li class="<?php echo (basename($_SERVER['PHP_SELF']) == $dashboard ? 'active' : '');?>"><a href="<?php echo $dashboard?>">Dashboard</a></li>
            <?php
        }
        ?>

        <?php
        if(!$user->isLoggedIn()){
            ?>
            <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active right' : 'right');?>"><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>
            <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active right' : 'right');?>"><a href="register.php"><span class="fa fa-book"></span> Register</a></li>
            <?php
        }else{
            ?>
            <li class="right"><a href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
            <?php
        }
        ?>

    </ul>
</nav>
