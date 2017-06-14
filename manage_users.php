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
$users = $user->getUsers();

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Manage Users</strong></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Settings</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            foreach ($users as $u){
                                $i ++;
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $u->username?></td>
                                    <td><?php echo $u->email?></td>
                                    <td>
                                        <a style="text-decoration: none">
                                            <button class="btn btn-success">Activate</button>
                                        </a>
                                        <a style="text-decoration: none">
                                            <button class="btn btn-danger">Deactivate</button>
                                        </a>
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

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
