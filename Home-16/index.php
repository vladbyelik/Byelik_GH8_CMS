<?php


    require "rb.php";
    R::setup( 'mysql:host=localhost;dbname=database',
        'root', '' );

    $data = $_POST;
    if(isset($data['do_sign-up'])) {

        $errors = array();

        if (trim($data['username']) == '' ) {
            $errors[] = 'Enter username!';
        }

        if (trim($data['email']) == '' ) {
            $errors[] = 'Enter your email!';
        }

        if ($data['password'] == '' ) {
            $errors[] = 'Enter your password!';
        }

        if (trim($data['repeat-password']) != $data['password'] ) {
            $errors[] = 'Password is not correctly! ';
        }

        if (trim($data['firstname']) == '' ) {
            $errors[] = 'Enter your First name!';
        }

        if (trim($data['lastname']) == '' ) {
            $errors[] = 'Enter your Last name!';
        }

        if (trim($data['age']) == '' ) {
            $errors[] = 'Enter your age!';
        }

        if (R::count('users', "username = ?", array($data['username'])) > 0 ) {
            $errors[] = 'User uzhe takoy login bil!';
        }

        if (R::count('users', "email = ?", array($data['email'])) > 0 ) {
            $errors[] = 'User uzhe takoy email bil!';
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
            echo '<div id="errors" style="color: green;">You are molodets!</div>';

        } else {
            echo '<div id="errors" style="color: red;">'.array_shift($errors).'</div>';
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<h1 class="text-center">Registration</h1>
<div class="container">
    <form action="index.php" method="POST" class="d-flex flex-lg-column">
        <label>
            <span>Username: </span><input type="text" name="username" value="<?php echo @$data['username']; ?>">
        </label>
        <label>
            <span>Email: </span><input type="email" name="email" value="<?php echo @$data['email']; ?>">
        </label>
        <label>
            <span>Password: </span><input type="password" name="password" value="<?php echo @$data['password']; ?>">
        </label>
        <label>
            <span>Repeat password: </span><input type="password" name="repeat-password" value="<?php echo @$data['repeat-password']; ?>">
        </label>
        <label>
            <span>First Name: </span><input type="text" name="firstname" value="<?php echo @$data['firstname']; ?>">
        </label>
        <label>
            <span>Last Name: </span><input type="text" name="lastname" value="<?php echo @$data['lastname']; ?>">
        </label>
        <label>
            <span>Age: </span><input type="text" name="age" value="<?php echo @$data['age']; ?>">
        </label>
        <label>
            <span>Gender: </span>
            <span>Male </span><input type="radio" name="gender" value="male">
            <span>Female </span><input type="radio" name="gender" value="female">
        </label>
        <label>
            <input type="submit" value="submit" name="do_sign-up">
        </label>
    </form>

    <p>
        HomeTask <a href="part2.php">part 2</a>
    </p>
</div>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
