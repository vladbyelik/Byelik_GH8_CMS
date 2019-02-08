<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
require "db.php";
$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'username = ?', array($data['username']));
    if ($user) {

        if (password_verify($data['password'], $user->password)) {
            $_SESSION['logged_user'] = $user;

            header ('Location: index.php');

        } else {
            $errors[] = 'Enter your password 000000';
        }
    } else {
        $errors[] = 'Enter username';
    }
    if (!empty($errors)) {
        echo '<div style="color: red;" class="text-center">' . array_shift($errors) . '</div>';
    }
}
?>

<div class="container text-center">
    <form action="login.php" method="post">
        <p>Login:</p>
        <label class="d-block">
            <input type="text" name="username" value="<?php echo @$data['username']; ?>">
        </label>
        <p>Password:</p>
        <label class="d-block">
            <input type="password" name="password" value="<?php echo @$data['password']; ?>">
        </label>
        <button type="submit" name="do_login">Enter</button>
    </form>
</div>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>