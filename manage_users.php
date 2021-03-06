<?php
require_once 'core/init.php';

include_once 'auth.php';
if (!$user->isLoggedIn()||!$user->isAdmin()) {
    Redirect::to('login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php' ?>
<body>

<?php include_once 'includes/navigation.php' ?>

<?php
$users = $user->getUsers();

?>

<div class="content">
    <div class="breadcrumb">
        <ul>
            <li><a href="user_dashboard.php">Dashboard</a>&raquo</li>
            <li><a href="manage_users.php">Manage Users</a>&raquo</li>
        </ul>
    </div>
    <div class="panel_background col-11">

        <div class="panel_heading">
            <strong>Manage Users</strong>
            <form style="float:right;">
                <label>Search</label>
                <input class="input_text col-8" type="text" id="userSearch" onkeyup="showResult(this.value,'searchUser')">
            </form>

        </div>
        <div class="panel_body" style="max-height: 350px;min-width: 100%;overflow: auto">
            <span id="count"></span>
            <table class="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Settings</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($users as $u) {
                    $i++;
                    ?>
                    <tr id="<?php echo "tr".$u->id?>" class="trcls">
                        <td><?php echo $i ?></td>
                        <td><?php echo $u->username ?></td>
                        <td><?php echo $u->fname ?></td>
                        <td><?php echo $u->lname ?></td>
                        <td>
                            <?php
                            if ($u->active == 1) {
                                ?>
                                <a href="manage_user_process.php?id=<?php echo $u->id ?>&set=0"
                                   style="text-decoration: none" onclick="return confirm('Are You Sure?')">
                                    <button class="btn btn-danger btn-sm" style="width: 100px">Deactivate</button>
                                </a>
                                <?php
                            } else {
                                ?>
                                <a href="manage_user_process.php?id=<?php echo $u->id ?>&set=1"
                                   style="text-decoration: none" onclick="return confirm('Are You Sure?')">
                                    <button class="btn btn-success btn-sm" style="width: 100px">Activate</button>
                                </a>
                                <?php
                            }
                            ?>


                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <!--                <div class="panel-footer"></div>-->
    </div>
</div>

<?php include_once 'includes/footer.php' ?>

</body>
</html>
