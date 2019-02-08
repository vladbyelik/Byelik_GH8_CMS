<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<div class="container">


    <div class="row">
        <div class="col-md-9">
            <div></div>
            <h1>All posts:</h1>
        </div>
    </div>


    <?php
    require 'db.php';

    $session_user = $_SESSION['logged_user']->username;

    $sql = "SELECT headline, textarea FROM `posts` WHERE username = '$session_user'";

    $query = [
        R::getAll($sql)
    ];

    function postToHTML($rows = []) {

        $html = '<div class="m-0 ml-auto mr-auto">';
        $columns = [];

        foreach ($rows as $row) {
            foreach ($row as $column => $value) {
                if (!in_array($column, $columns)) {
                    array_push($columns, $column);
                }
            }
        }
        foreach ($rows as $row) {
            foreach ($columns as $column) {

                $html .= "<p>$row[$column]</p>";
            }
        }
        $html .= '</div>';
        return $html;
    }
    echo postToHTML($query[0]);
    ?>



    <a class="d-block" href="post-create.php">Create a new post</a>
    <a class="d-block" href="index.php">Main page</a>

    <a class="d-block" href="logout.php">Exit!</a>
</div>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
