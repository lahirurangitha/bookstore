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

<?php


?>

<div class="container">
    <div class="row">
        <div class="col-xs-7 col-xs-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Upload Books</strong></div>
                <div class="panel-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <input name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
                <!--                <div class="panel-footer"></div>-->
            </div>
        </div>

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
