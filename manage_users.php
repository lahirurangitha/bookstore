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
                                        <?php
                                        if($u->active==1){
                                            ?>
                                            <a href="manage_user_process.php?id=<?php echo $u->id?>&set=0" style="text-decoration: none" onclick="return confirm('Are You Sure?')">
                                                <button class="btn btn-danger btn-sm" style="width: 100px">Deactivate</button>
                                            </a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="manage_user_process.php?id=<?php echo $u->id?>&set=1" style="text-decoration: none" onclick="return confirm('Are You Sure?')">
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

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
