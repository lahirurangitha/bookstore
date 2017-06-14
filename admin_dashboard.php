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

<div class="container">
    <div class="row">

    </div>
</div>

<?php include_once 'includes/footer.php'?>

</body>
</html>
