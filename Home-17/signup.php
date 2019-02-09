<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="container">
    <div class="input-block">
        <h2 class="text-center">Registration</h2>

        <?php
        require "db.php";
        $data = $_POST;
        if (isset($data['do_sign-up'])) {
            $errors = array();
            if (trim($data['username']) == '') {
                $errors[] = 'Enter username!';
            }
            if (trim($data['email']) == '') {
                $errors[] = 'Enter your email!';
            }
            if ($data['password'] == '') {
                $errors[] = 'Enter your password!';
            }
            if (trim($data['repeat-password']) != $data['password']) {
                $errors[] = 'Passwords do not match!';
            }
            if (trim($data['firstname']) == '') {
                $errors[] = 'Enter your First name!';
            }
            if (trim($data['lastname']) == '') {
                $errors[] = 'Enter your Last name!';
            }
            if (trim($data['age']) == '') {
                $errors[] = 'Enter your age!';
            }
            if (R::count('users', "email = ?", array($data['email'])) > 0) {
                $errors[] = 'User with such email already exists!';
            }
            if (empty($errors)) {
                $user = R::dispense('users');
                $user->username = $data['username'];
                $user->email = $data['email'];
                $user->firstname = $data['firstname'];
                $user->lastname = $data['lastname'];
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->age = $data['age'];
                $user->gender = $data['gender'];
                R::store($user);
                echo '<div style="color: green;" class="text-center">You have successfully registered! Click <a href="login.php">here</a> to authorise!</div>';
            } else {
                echo '<div style="color: red;" class="text-center">' . array_shift($errors) . '</div>';
            }
        }
        ?>

        <form action="signup.php" method="POST" class="form-signup">
            <label>
                <input class="input" type="text" name="username" placeholder="enter username"
                       value="<?php echo @$data['username']; ?>">
            </label>
            <label>
                <input class="input" type="email" name="email" placeholder="enter your email"
                       value="<?php echo @$data['email']; ?>">
            </label>
            <label>
                <input class="input" type="password" name="password" placeholder="enter your password"
                       value="<?php echo @$data['password']; ?>">
            </label>
            <label>
                <input class="input" type="password" name="repeat-password" placeholder="repeat password"
                       value="<?php echo @$data['repeat-password']; ?>">
            </label>
            <label>
                <input class="input" type="text" name="firstname" placeholder="enter your first name"
                       value="<?php echo @$data['firstname']; ?>">
            </label>
            <label>
                <input class="input" type="text" name="lastname" placeholder="enter your last name"
                       value="<?php echo @$data['lastname']; ?>">
            </label>
            <label>
                <input class="input" type="number" name="age" placeholder="enter your age"
                       value="<?php echo @$data['age']; ?>">
            </label>
            <label>
                <span>Male </span><input type="radio" name="gender" value="male">
                <span>Female </span><input type="radio" name="gender" value="female">
            </label>
            <label>
                <input class="submit" type="submit" value="Registration" name="do_sign-up">
            </label>
            <div class="links"><a class="submit" href="index.php">Main page</a></div>
        </form>
    </div>
</div>
<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>