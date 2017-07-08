<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn() || !$user->isAdmin()) {
    Redirect::to('login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php' ?>
<body>

<?php include_once 'includes/navigation.php' ?>

<?php


?>

<div class="content">
    <div class="breadcrumb">
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a>&raquo</li>
            <li><a href="upload_books.php">Upload Books</a>&raquo</li>
        </ul>
    </div>
    <div class="panel_background col-9">

        <div class="panel_heading"><strong>Upload Books</strong></div>
        <div class="panel_body">
            <form method="post" action="upload_books_process.php" enctype="multipart/form-data">
                <div class="">
                    <label>Name</label><br>
                    <input class="input_text" type="text" name="name" placeholder="Enter name">
                </div>
                <div class="">
                    <label>ISBN</label><br>
                    <input class="input_text" type="text" name="isbn" placeholder="Enter ISBN">
                </div>
                <input name="books[]" type="file"/>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="submit" value="Upload" class="input_submit">
            </form>
        </div>
        <!--                <div class="panel-footer"></div>-->



    </div>
</div>


<?php include_once 'includes/footer.php' ?>

</body>
</html>
