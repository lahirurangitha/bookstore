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
        <div class="panel_heading">
            <strong>Books</strong>
            <form style="float:right;">
                <label>Search</label>
                <input class="input_text col-8" type="text" id="bookSearch" onkeyup="showResult(this.value,'searchBook')">
            </form>
        </div>
        <div class="panel_body" style="max-height: 350px;min-width: 100%;overflow: auto">
            <span id="count"></span>
            <?php
            $book = new Book();
            $books = $book->getAll();
            if (count($books)) {
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>ISBN</th>
                        <th>Size</th>
                        <th>Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach ($books as $b) {
                        $i++;
                        ?>
                        <tr id="<?php echo "tr" . $b->id ?>" class="trcls">
<!--                            <td>--><?php //echo $i ?><!--</td>-->
                            <td><img src="styles/img/icons/pdf-icon.png" style="height: 50px"></td>
                            <td><?php echo $b->display ?></td>
                            <td><?php echo $b->isbn ?></td>
                            <td><?php
                                if (round(filesize($b->location) * .0009765625) >= 1000) {
                                    echo (round(filesize($b->location) * .0009765625 * .0009765625)) . " MB";
                                } else {
                                    echo (round(filesize($b->location) * .0009765625)) . " KB";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="download_books.php?id=<?php echo $b->id ?>">Download</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
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
