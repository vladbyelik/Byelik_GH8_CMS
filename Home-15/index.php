<?php
    $num = array_key_exists('num', $_POST) ? $_POST['num'] : null;
    $nums = array_key_exists('nums', $_POST) ? $_POST['nums'] : [];
    function do_sort(&$arr)
    {
        for($i = 0; $i < count($arr); $i++)
        {
            $vr = $arr[$i];
            $vl = $i - 1;
            while($vl >= 0 && $arr[$vl] > $vr)
            {
                $arr[$vl+1] = $arr[$vl];
                $vl--;
            }
            $arr[++$vl] = $vr;
        }
        return $arr;
    }
    if ($num) {
        array_push($nums, $num);
        do_sort($nums);
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
<div class="container">
    <h1 class="text-center">Введите число:</h1>
    <form method="post">
        <input id="input" type="number" name="num" placeholder="write a number">
        <?php foreach($nums as $n): ?>
            <input type="hidden" name="nums[]" value="<?php echo $n; ?>">
        <?php endforeach; ?>
        <button>ADD</button>
    </form>
    <pre>
    <?php print_r($nums); ?>
    </pre>
</div>
<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>