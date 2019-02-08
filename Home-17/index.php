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
?>
<?php if (isset($_SESSION['logged_user'])) : {

    ?>
    <div class="text-center">
        <h1><?php echo 'You are logged in! Hi, ', $_SESSION['logged_user']->username, '!' ; } ?></h1>

        <a class="d-block" href="post-create.php">Create a new post</a>
        <a class="d-block" href="posts.php">Show already created posts</a>


        <a class="d-block" href="logout.php">Exit!</a>
    </div>


<?php else : ?>

<div class="text-center">
    <h1>Hi, guest! Welcome to the home page!</h1>
    <a href="login.php" class="d-block">Authorisation</a>
    <a href="signup.php">Registration</a>
</div>


<?php endif; ?>
<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
