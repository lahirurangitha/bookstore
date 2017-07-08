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
    <div class="breadcrumb">
        <ul>
            <li><a href="user_dashboard.php">Dashboard</a>&raquo</li>
            <li><a href="books.php">Books</a>&raquo</li>
        </ul>
    </div>
    <div class="panel_background col-11">
        <div class="panel_heading"><strong>Books</strong></div>
        <div class="panel_body" style="max-height:400px; overflow:auto;">
            <?php
            $sql = 'SELECT * FROM book';
            $books_db = DB::getInstance();
            $books_db->query($sql, array());
            $books = $books_db->results();
            if (count($books)) {
                ?>

                <?php
                $i = 0;
                foreach ($books as $book) {
                    $i++;
                    ?>
                    <div class="panel_link col-2" style="display: inline-block;">
                        <a href="download_books.php?id=<?php echo $book->id ?>">
                            <img src="styles/img/icons/pdf-icon.png" class="book">
                            <span><?php echo ucfirst($book->display)?></span>
                        </a>

                    </div>
                    <?php
                }
            } else {
                echo 'No books found';
            }
            ?>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php' ?>
</body>

</html>
