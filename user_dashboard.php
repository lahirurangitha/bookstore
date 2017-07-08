<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
}
if ($user->isAdmin()) {
    Redirect::to('login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include_once 'includes/header.php' ?>

<body>

<?php include_once 'includes/navigation.php' ?>

<div class="content">
    <div class="panel_background col-11" style="display: flex">
        <div class="panel_item col-2 panel_link">
            <a href="update_profile.php">
                <div class="">
                    <div class="panel_item_heading"><strong>Update Profile</strong></div>
                    <div class="panel_body"><img src="styles/img/icons/update_profile.png" class="panel_img"></div>

                </div>
            </a>
        </div>
        <div class="panel_item col-2 panel_link">
            <a href="books.php">
                <div class="">
                    <div class="panel_item_heading"><strong>Get a book</strong></div>
                    <div class="panel_body"><img src="styles/img/icons/books.png" class="panel_img"></div>
                    <!--                <div class="panel-footer"></div>-->
                </div>
            </a>
        </div>
    </div>
</div>

<!--<div class="content">-->
<!--    <div class="panel_background col-11">-->
<!--        <div class="panel_heading"><strong>Books</strong></div>-->
<!--        <div class="panel_body" style="max-height:400px; overflow:auto;">-->
<!--            --><?php
//            $sql = 'SELECT * FROM book';
//            $books_db = DB::getInstance();
//            $books_db->query($sql, array());
//            $books = $books_db->results();
//            if (count($books)) {
//                ?>
<!---->
<!--                --><?php
//                $i = 0;
//                foreach ($books as $book) {
//                    $i++;
//                    ?>
<!--                    <div class="panel_link col-2" style="display: inline-block;">-->
<!--                        <a href="download_books.php?id=--><?php //echo $book->id ?><!--">-->
<!--                            <img src="styles/img/icons/pdf-icon.png" class="book">-->
<!--                            <span>--><?php //echo ucfirst($book->name)?><!--</span>-->
<!--                        </a>-->
<!---->
<!--                    </div>-->
<!--                    --><?php
//                }
//            } else {
//                echo 'No books found';
//            }
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php include_once 'includes/footer.php' ?>
</body>

</html>
