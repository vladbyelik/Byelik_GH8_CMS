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
?>

<div class="container">
    <div class="input-block">
        <form action="post-create.php" method="post">
            <h2>Create your post</h2>

            <?php
            if (isset($data['do_create-post'])) {
                $errors = array();
                if ($data['headline'] == '') {
                    $errors[] = 'Enter post headline';
                }
                if ($data['textarea'] == '') {
                    $errors[] = 'Enter post text';
                }
                if (empty($errors)) {
                    $user = R::dispense('posts');
                    $user->username = $_SESSION['logged_user']->username;
                    $user->date = date("d.m.y G:i:s");
                    $user->headline = $data['headline'];
                    $user->textarea = $data['textarea'];
                    R::store($user);
                    echo '<div style="color: green;" class="echo text-center">Done! Click <a href="posts.php">here</a> to see them!</div>';
                } else {
                    echo '<div style="color: red;" class="echo text-center">' . array_shift($errors) . '</div>';
                }
            }
            ?>

            <label class="d-block">
                <input placeholder="Enter post title" class="input" type="text" name="headline"
                       value="<?php echo @$data['headline']; ?>">
            </label>
            <h3 class="mr-auto ml-auto">Enter your post:</h3>
            <label>
                <textarea name="textarea" class="input textarea mr-auto ml-auto d-block" cols="30" rows="10"></textarea>
            </label>
            <input class="submit" name="do_create-post" type="submit" value="Create post">
        </form>
        <div class="links">
            <a class="submit d-block ml-auto mr-auto" href="posts.php">My created posts</a>
            <a class="submit d-block ml-auto mr-auto" href="logout.php">Exit</a>
        </div>
    </div>
</div>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
