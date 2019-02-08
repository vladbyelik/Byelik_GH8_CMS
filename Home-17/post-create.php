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

$data = $_POST;

if(isset($data['do_create-post'])) {
    $errors = array();
    if ($data['headline'] == '') {
        $errors[] = 'Enter post headline!';
    }
    if ($data['textarea'] == '') {
        $errors[] = 'Enter post text!';
    }

    if (empty($errors)) {
        $user = R::dispense('posts');
        $user->username = $_SESSION['logged_user']->username;
        $user->date = date("l dS of F Y h:i:s A");
        $user->headline = $data['headline'];
        $user->textarea = $data['textarea'];
        R::store($user);
        echo '<div style="color: green;" class="text-center">Your post have successfully created into database! Click <a href="posts.php">here</a> to see them!</div>';
    } else {
        echo '<div style="color: red;" class="text-center">'.array_shift($errors).'</div>';
    }
}
?>

<div class="text-center">
    <form action="post-create.php" method="post">
        <span>Headline: </span>
        <label class="d-block">
            <input type="text" name="headline" value="<?php echo @$data['headline']; ?>">
        </label>
        <span>Your post: </span>
        <label class="d-block">
            <input type="text" name="textarea" value="<?php echo @$data['textarea']; ?>">
        </label>
        <input type="submit" value="Create post" name="do_create-post">
    </form>
    <a class="d-block" href="posts.php">My created posts</a>
    <a class="d-block" href="logout.php">Exit!</a>
</div>




<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
