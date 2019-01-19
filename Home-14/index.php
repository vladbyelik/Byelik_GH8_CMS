<?php
$data = require('data.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data['site-title']; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><img class="img-responsive" src="<?php echo $data['header']['siteLogo']; ?>" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php foreach ($data['header']['menu'] as $menuItem): ?>
                        <li class="nav-item"><a href="#" class="nav-link"><?= $menuItem; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <h1 class="text-center"><?= $data['header']['h1']; ?></h1>
        <h2 class="text-center"><?= $data['header']['h2']; ?></h2>
        <div class="link ml-auto mr-auto"><?= $data['button']; ?></div>
        <div class="mouse ml-auto mr-auto"></div>
        <span class="scroll"><?= $data['header']['scroll']?></span>
    </div>
</header>
<section class="design-code">
    <div class="container d-flex justify-content-between">
        <div class="best-design-code">
            <h2><?= $data['design-section']['h2-design'] ?></h2>
            <span><?= $data['design-section']['span'] ?></span>
            <div class="link"><?= $data['button']; ?></div>
        </div>
        <div class="best-design-code">
            <h2><?= $data['design-section']['h2-code'] ?></h2>
            <span><?= $data['design-section']['span'] ?></span>
            <div class="link"><?= $data['button']; ?></div>
        </div>
    </div>
</section>
<section class="what-we-do">
    <div class="container">
        <h2 class="text-center">What we do?</h2>
        <ul class="services">
            <li class="d-flex">
                <div class="notebook"></div>
                <div class="text">
                    <h3>Web design</h3>
                    <span><?= $data['what-we-do']['span'] ?></span>
                </div>
            </li>
            <li class="d-flex">
                <div class="web-app"></div>
                <div class="text">
                    <h3>Web Applications</h3>
                    <span><?= $data['what-we-do']['span'] ?></span>
                </div>
            </li>
        </ul>
        <ul class="services d-flex">
            <li class="d-flex">
                <div class="painting"></div>
                <div class="text">
                    <h3>Digital painting</h3>
                    <span><?= $data['what-we-do']['span'] ?></span>
                </div>
            </li>
            <li class="d-flex">
                <div class="desktop-apps"></div>
                <div class="text">
                    <h3>Desktop Applications</h3>
                    <span><?= $data['what-we-do']['span'] ?></span>
                </div>
            </li>
        </ul>
        <div class="link mr-auto ml-auto"><?= $data['button']; ?></div>
    </div>
</section>
<section class="pic d-flex justify-content-center">
    <div class="drone-zone d-flex align-items-center">
        <div class="info text-center">
            <h2><?= $data['pic']['h2'] ?></h2>
            <span><?= $data['pic']['span'] ?></span>
            <div class="link mr-auto ml-auto"><?= $data['pic']['button'] ?></div>
        </div>
    </div>
    <div class="monthly d-flex align-items-center">
        <div class="info text-center">
            <h2><?= $data['pic']['h2'] ?></h2>
            <span><?= $data['pic']['span'] ?></span>
            <div class="link mr-auto ml-auto"><?= $data['pic']['button'] ?></div>
        </div>
    </div>
    <div class="fit-app d-flex align-items-center">
        <div class="info text-center">
            <h2><?= $data['pic']['h2'] ?></h2>
            <span><?= $data['pic']['span'] ?></span>
            <div class="link mr-auto ml-auto"><?= $data['pic']['button'] ?></div>
        </div>
    </div>
</section>
<section class="about-us text-center">
    <div class="container">
        <h2><?= $data['about-us']['h2'] ?></h2>
        <h3><?= $data['about-us']['h3'] ?></h3>
        <ul class="personal d-flex justify-content-between">
            <?php foreach ($data['about-us']['img'] as $people): ?>
                <li>
                    <img alt="per" src="<?php echo $people?>">
                    <h4><?= $data['about-us']['h4'] ?></h4>
                    <span><?= $data['about-us']['span'] ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="link mr-auto ml-auto"><?= $data['button'] ?></div>
    </div>
</section>
<div class="map"></div>
<footer>
    <div class="container">
        <span class="d-block"><?= $data['footer']['span'] ?></span>
        <span class="d-block"><?= $data['footer']['span-end']?></span>
    </div>
</footer>
<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>