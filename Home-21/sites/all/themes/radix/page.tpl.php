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

    <nav class="navbar navbar-default d-flex justify-content-between" role="navigation">
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
      </div>

    </nav>


    <div id="main-wrapper">
        <div id="main" class="main">
            <div class="container">
                <div id="page-header">
                    <?php if ($title): ?>
                        <div class="page-header">
                            <h1 class="title"><?php print $title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if ($tabs): ?>
                        <div class="tabs">
                            <?php print render($tabs); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($action_links): ?>
                        <ul class="action-links">
                            <?php print render($action_links); ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php $topPageHeading = check_plain(theme_get_setting('first_section_heading', 'radix')); ?>

                <h1><?php echo $topPageHeading; ?></h1>
            </div>
            <div id="content" class="container">
                <?php print render($page['content']); ?>
            </div>
        </div> <!-- /#main -->
    </div>

  </div> <!-- /.container -->

</header>

<section class="design-code"></section>

<section class="what-we-do"></section>

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
