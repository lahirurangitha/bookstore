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
        <div class="col-5" style="float: left">
            <strong style="font-size: 75px" class="col-1-offset">Welcome</strong><br>
            <img src="styles/img/logo.png"><br>

            <h3 class="col-1-offset">Please Log In OR Register to Continue</h3>

        </div>
        <div class="col-5" style="float: right;max-height: 350px;overflow: auto">
        <?php
        $book = new Book();
        $books = $book->getAll();
        if (count($books)) {
            ?>
            <strong style="font-size: 50px">Available Books</strong>
            <ul>
                <?php
                foreach ($books as $b) {?>
                    <li><?php echo "<strong>$b->name</strong> (available {$b->count}) copies."?></li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        ?>


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
