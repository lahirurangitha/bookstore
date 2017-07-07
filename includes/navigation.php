<!-- Navigation -->
<!--<nav class="navbar navbar-default">-->
<!--    <div class="container-fluid">-->
<!--        <div class="navbar-header">-->
<!--            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--                <span class="icon-bar"></span>-->
<!--            </button>-->
<!--            <a class="navbar-brand" href="index.php">Bookstore</a>-->
<!--        </div>-->
<!--        <div class="collapse navbar-collapse">-->
<!--            <ul class="nav navbar-nav">-->
<!--                --><?php
//                if($user->isLoggedIn()){
//                    $user->isAdmin()?$dashboard = 'admin_dashboard.php':$dashboard = 'user_dashboard.php';
//                    ?>
<!--                    <li class="--><?php //echo (basename($_SERVER['PHP_SELF']) == $dashboard ? 'active' : '');?><!--"><a href="--><?php //echo $dashboard?><!--">Dashboard</a></li>-->
<!--                    --><?php
//                }
//                ?>
<!--                <li><a href="#">Projects</a></li>-->
<!--                <li><a href="#">Contact</a></li>-->
<!--            </ul>-->
<!--            <ul class="nav navbar-nav navbar-right">-->
<!--                --><?php
//                if(!$user->isLoggedIn()){
//                    ?>
<!--                    <li class="--><?php //echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '');?><!--"><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>-->
<!--                    <li class="--><?php //echo (basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : '');?><!--"><a href="register.php"><span class="fa fa-book"></span> Register</a></li>-->
<!--                    --><?php
//                }else{
//                    ?>
<!--                    <li><a href="logout.php"><span class="fa fa-sign-out"></span> logout</a></li>-->
<!--                --><?php
//                }
//                ?>
<!---->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->

<nav class="nav">
    <ul>
        <li><a href="index.php">Bookstore</a></li>
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
