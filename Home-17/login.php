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

?>


<div class="login login-page text-center">

    <h3 class="text-center">Authorisation</h3>

    <?php

    if (isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'username = ?', array($data['username']));

        if (trim($data['username']) == '' ) {
            $errors[] = 'Enter username!';
        }

        if ($data['password'] == '' ) {
            $errors[] = 'Enter your password!';
        }

        if (!empty($errors)) {
            echo '<div style="color: red;" class="text-center echo">' . array_shift($errors) . '</div>';
        }

        if (R::count('users', "username = 0", array($data['username']))) {
            $errors[] = 'User with such login does not exists!';
        }

        if ($user) {

            if (password_verify($data['password'], $user->password)) {
                $_SESSION['logged_user'] = $user;

                header ('Location: index.php');

            } else {
                $errors[] = 'Password or username is incorrect';
            }
        }

//        if ($user) {
//
//            if (password_verify($data['password'], $user->password)) {
//                $_SESSION['logged_user'] = $user;
//
//                header ('Location: index.php');
//
//            } else {
//                $errors[] = 'Password or username is incorrect';
//            }
//        } else {
//            $errors[] = 'Enter username';
//        }


        if (!empty($errors)) {
            echo '<div style="color: red;" class="text-center echo">' . array_shift($errors) . '</div>';
        }
    }
    ?>


    <form action="login.php" method="post">

        <label class="d-block">
            <input class="input" type="text" placeholder="enter username" name="username" value="<?php echo @$data['username']; ?>">
        </label>
        <label class="d-block">
            <input class="input" type="password" placeholder="enter your password" name="password" value="<?php echo @$data['password']; ?>">
        </label>
        <button class="submit" type="submit" name="do_login">Enter</button>

    </form>
    <div class="links"><a class="submit d-block ml-auto mr-auto" href="index.php">Main page</a></div>


</div>



<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>