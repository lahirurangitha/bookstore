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

<div class="content">
    <div class="panel_background col-12" style="display: flex">
        <div class="panel_item col-2 panel_link">
            <a href="manage_users.php">
            <div class="">
                <div class="panel_heading"><strong>Manage Users</strong></div>
                <div class="panel_body"><img src="styles/img/icons/manage_users.png" class="panel_img"></div>
<!--                <div class="panel-footer"></div>-->
            </div>
            </a>
        </div>
        <div class="panel_item col-2 panel_link">
            <a href="upload_books.php">
                <div class="">
                    <div class="panel_heading"><strong>Upload Books</strong></div>
                    <div class="panel_body"><img src="styles/img/icons/upload_books.png" class="panel_img"></div>
<!--                                    <div class="panel-footer"></div>-->
                </div>
            </a>
        </div>

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
