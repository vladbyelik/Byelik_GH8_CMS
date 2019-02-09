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
        <h2>All your posts:</h2>

        <?php
        require 'db.php';
        $session_user = $_SESSION['logged_user']->username;
        $sql = "SELECT headline, textarea, date FROM `posts` WHERE username = '$session_user'";
        $query = [
            R::getAll($sql)
        ];
        function postsToHTML($posts = []) {
            $html = '<div class="container">';
            foreach ($posts as $post) {
                $html .= "
                <div class='post'>
                    <h3><strong>{$post['headline']}</strong></h3>
                    <p>{$post['textarea']}</p>
                    <p>{$post['date']}</p>
                </div>
            ";
                if ($post['headline'] == '') {
                    echo 'empty!';
                }
            }
            $html .= '</div>';
            return $html;
        }
        echo postsToHTML($query[0]);
        ?>

        <div class="links">
            <a class="submit" href="post-create.php">Create a new post</a>
            <a class="submit" href="index.php">Main page</a>
            <a class="submit" href="logout.php">Exit</a>
        </div>
    </div>
</div>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
