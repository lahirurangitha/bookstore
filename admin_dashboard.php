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

<?php include_once 'includes/navigation.php'?>

<div class="container">
    <div class="row">

        <div class="col-xs-3">
            <a href="manage_users.php" style="text-decoration: none;">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><strong>Manage Users</strong></div>
                <div class="panel-body"><img src="styles/img/icons/manage_users.png" class="img_icon center-block"></div>
<!--                <div class="panel-footer"></div>-->
            </div>
            </a>
        </div>
        <div class="col-xs-3">
            <a href="upload_books.php" style="text-decoration: none;">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Upload Books</strong></div>
                    <div class="panel-body"><img src="styles/img/icons/upload_books.png" class="img_icon center-block"></div>
                    <!--                <div class="panel-footer"></div>-->
                </div>
            </a>
        </div>

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
