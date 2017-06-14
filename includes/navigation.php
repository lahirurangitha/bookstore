<!-- Navigation -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Bookstore</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">About</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(!$user->isLoggedIn()){
                    ?>
                    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '');?>"><a href="login.php"><span class="fa fa-sign-in"></span> Login</a></li>
                    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : '');?>"><a href="register.php"><span class="fa fa-book"></span> Register</a></li>
                    <?php
                }else{
                    ?>
                    <li><a href="logout.php"><span class="fa fa-sign-out"></span> logout</a></li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
