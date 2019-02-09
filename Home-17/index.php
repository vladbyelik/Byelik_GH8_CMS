<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
    require 'db.php';

 if (isset($_SESSION['logged_user'])) : {   ?>

    <div class="container">
     <div class="text-center login-page">
     <h1><?php echo 'You are logged in! <br> Hello, ', $_SESSION['logged_user']->username, '!' ; } ?></h1>
     <div class="links">
         <a class="submit" href="post-create.php">Create a new post</a>
         <a class="submit" href="posts.php">Show created posts</a>
         <a class="submit" href="logout.php">Exit</a>
     </div>
     </div>
    </div>

<?php else : ?>

<div class="text-center mr-auto ml-auto login-page login">
    <h1 class="d-block">Hi, guest! Welcome to the home page!</h1>
    <div class="links d-flex justify-content-around">
        <a class="submit" href="login.php">Authorisation</a>
        <a class="submit" href="signup.php">Registration</a>
    </div>
</div>


<?php endif; ?>
<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
