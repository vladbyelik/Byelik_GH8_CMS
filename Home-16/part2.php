<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
    require "assets/libs/rb.php";
    R::setup( 'mysql:host=localhost;dbname=database-home16',
        'root', '' );

    $queries = [
            R::getAll(file_get_contents('assets/db-queries/query1.sql')),
            R::getAll(file_get_contents('assets/db-queries/query2.sql')),
            R::getAll(file_get_contents('assets/db-queries/query3.sql')),
            R::getAll(file_get_contents('assets/db-queries/query4.sql'))
    ];


    function rowsToHTML($rows = []) {
        $html = '<table>';
        $columns = [];

        $html .= '<thead><tr>';
        foreach ($rows as $row) {
            foreach ($row as $column => $value) {
                if (!in_array($column, $columns)) {
                    array_push($columns, $column);
                    $html .= "<th>{$column}</th>";
                }
            }
        }
        $html .= '</tr></thead>';

        $html .= '<tbody>';
        foreach ($rows as $row) {
            $html .= "<tr>";
            foreach ($columns as $column) {
                $html .= "<td>$row[$column]</td>";
            }
            $html .= "</tr>";
        }
        $html .= '</tbody>';

        $html .= '</table>';
        return $html;
    }

    echo rowsToHTML($queries[0]);
    echo '<hr>';
    echo rowsToHTML($queries[1]);
    echo '<hr>';
    echo rowsToHTML($queries[2]);
    echo '<hr>';
    echo rowsToHTML($queries[3]);
?>

<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>