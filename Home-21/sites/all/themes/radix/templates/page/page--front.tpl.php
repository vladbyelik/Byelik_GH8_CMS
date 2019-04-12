<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 */
?>

<header id="header" class="header" role="header">


    <div class="container">

        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if ($site_name || $logo): ?>
                    <a href="<?php print $front_page; ?>" class="navbar-brand" rel="home" title="<?php print t('Home'); ?>">
                        <?php if ($logo): ?>
                            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo" />
                        <?php endif; ?>
                        <?php if ($site_name): ?>
                            <span class="site-name"><?php print $site_name; ?></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>


            <div class="collapse navbar-collapse" id="navbar-collapse">
                <?php if ($main_menu): ?>
                    <ul id="main-menu" class="menu nav navbar-nav">
                        <?php print render($main_menu); ?>
                    </ul>
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->

        </nav><!-- /.navbar -->


        <div id="main-wrapper">
            <div id="main" class="main">


<!--                    <div id="page-header">-->
<!--                        --><?php //if ($title): ?>
<!--                            <div class="page-header">-->
<!--                                <h1 class="title">--><?php //print $title; ?><!--</h1>-->
<!--                            </div>-->
<!--                        --><?php //endif; ?>
<!--                        --><?php //if ($tabs): ?>
<!--                            <div class="tabs">-->
<!--                                --><?php //print render($tabs); ?>
<!--                            </div>-->
<!--                        --><?php //endif; ?>
<!--                        --><?php //if ($action_links): ?>
<!--                            <ul class="action-links">-->
<!--                                --><?php //print render($action_links); ?>
<!--                            </ul>-->
<!--                        --><?php //endif; ?>
<!--                    </div>-->

                    <?php $topPageHeading = check_plain(theme_get_setting('header_heading', 'radix')); ?>
                    <?php $topPageCaption = check_plain(theme_get_setting('header_caption', 'radix')); ?>

                    <h1><?php echo $topPageHeading; ?></h1>

                    <h2><?php echo $topPageCaption; ?></h2>

                    <div class="link">
                        <?php echo render($page['button']); ?>
                    </div>


<!--                vivod kontenta-->

<!--                <div id="content" class="container">-->
<!--                    --><?php //print render($page['content']); ?>
<!--                </div>-->

            </div> <!-- /#main -->
        </div> <!-- /#main wrapper -->

        <div class="mouse"></div>
        <span class="scroll">scroll down</span>

    </div>

</header>

<section class="design-code">

    <div id="content" class="container">

        <ul class="best">

            <?php $firstSectionHeading = check_plain(theme_get_setting('first_section_heading', 'radix')); ?>
            <?php $firstSectionCaption = check_plain(theme_get_setting('first_section_caption', 'radix')); ?>

            <li class="main best-design-code">
                <h2><?php echo $firstSectionHeading; ?></h2>
                <span class="span"><?php echo $firstSectionCaption; ?></span>

                <div class="link">
                    <?php echo render($page['button']); ?>
                </div>
            </li>

            <li class="main best-design-code">
                <h2><?php echo $firstSectionHeading; ?></h2>
                <span class="span"><?php echo $firstSectionCaption; ?></span>

                <div class="link">
                    <?php echo render($page['button']); ?>
                </div>
            </li>

        </ul>
    </div>

</section>

<section class="what-we-do">

    <div class="container">
        <?php $secondSectionHeading = check_plain(theme_get_setting('second_section_heading', 'radix')); ?>

        <h2><?php echo $secondSectionHeading; ?></h2>

        <div class="main-wrapper">
            <div id="main" class="main">
                <?php print render($page['content']); ?>
            </div>
        </div>

    </div>

</section>

<section class="pic d-flex justify-content-center"></section>

<section class="about-us"></section>

<div class="map"></div>



<footer id="footer" class="footer" role="footer">
    <div class="container">
        <!--    --><?php //if ($copyright): ?>
        <!--      <small class="copyright pull-left">--><?php //print $copyright; ?><!--</small>-->
        <!--    --><?php //endif; ?>
        <!--    <small class="pull-right"><a href="#">--><?php //print t('Back to Top'); ?><!--</a></small>-->
    </div>
</footer>
