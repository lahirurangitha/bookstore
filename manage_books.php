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
            <li><a href="manage_books.php">Search & Remove Books</a>&raquo</li>
        </ul>
    </div>
    <div class="panel_background col-11">
        <div class="panel_heading">
            <strong>Manage Books</strong>

            <form style="float:right;">
                <label>Search</label>
                <input class="input_text col-8" type="text" id="bookSearch"
                       onkeyup="showResult(this.value,'searchBook')">
            </form>
        </div>
        <div class="panel_body" style="max-height: 350px;min-width: 100%;overflow: auto">
            <span id="count"></span>
            <?php
            $sql = 'SELECT * FROM book';
            $books_db = DB::getInstance();
            $books_db->query($sql, array());
            $books = $books_db->results();
            if (count($books)){
            ?>
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>ISBN</th>
                    <th>Available count</th>
                    <th>Downloaded count</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($books as $book) {
                    $i++;
                    ?>
                    <tr id="<?php echo "tr" . $book->id ?>" class="trcls">
                        <td><?php echo $i ?></td>
                        <td><?php echo $book->name ?></td>
                        <td><?php echo $book->isbn ?></td>
                        <td><?php echo $book->count ?></td>
                        <td><?php echo $book->download_count ?></td>
                        <td>
                            <a href="delete_books.php?id=<?php echo $book->id ?>"
                               style="text-decoration: none" onclick="return confirm('Are You Sure?')">
                                <button style="width: 100px">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                } else {
                    echo '<tr>No books found</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>


    </div>
</div>


<?php include_once 'includes/footer.php' ?>

</body>
</html>
