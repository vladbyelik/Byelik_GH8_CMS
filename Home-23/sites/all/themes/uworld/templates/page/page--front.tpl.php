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
      </div> <!-- /.navbar-header -->

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <?php if ($main_menu): ?>
          <ul id="main-menu" class="menu nav navbar-nav">
            <?php print render($main_menu); ?>
          </ul>
        <?php endif; ?>
<!--        --><?php //if ($search_form): ?>
<!--          --><?php //print $search_form; ?>
<!--        --><?php //endif; ?>
      </div><!-- /.navbar-collapse -->
    </nav><!-- /.navbar -->
      <?php $topPageHeading = check_plain(theme_get_setting('header_heading', 'uworld')); ?>
      <h1><?php print $topPageHeading; ?></h1>
      <?php $topPageCaption = check_plain(theme_get_setting('header_caption', 'uworld')); ?>
      <h2><?php print $topPageCaption; ?></h2>
      <?php $topPageLinkName = check_plain(theme_get_setting('header_link', 'uworld')); ?>
      <div class="link"><a href="#"><?php print $topPageLinkName; ?></a></div>
  </div> <!-- /.container -->
</header>

<div id="main-wrapper">
  <div id="main" class="main">
    <div class="container">
      <?php if ($breadcrumb): ?>
        <div id="breadcrumb" class="visible-desktop">
          <?php print $breadcrumb; ?>
        </div>
      <?php endif; ?>
      <?php if ($messages): ?>
        <div id="messages">
          <?php print $messages; ?>
        </div>
      <?php endif; ?>
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
    </div>
    <div id="content">
      <?php print render($page['content']); ?>
    </div>
  </div> <!-- /#main -->
</div> <!-- /#main-wrapper -->

<footer id="footer" class="footer" role="footer">
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
          </div> <!-- /.navbar-header -->

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
              <?php if ($main_menu): ?>
                  <ul id="main-menu" class="menu nav navbar-nav">
                      <?php print render($main_menu); ?>
                  </ul>
              <?php endif; ?>
              <form action="#">
                  <span>Join our newsletter</span>
                  <div>
                      <input type="email" placeholder="E-mail Address">
                      <button class="link">Subscribe</button>
                  </div>
              </form>
          </div><!-- /.navbar-collapse -->
      </nav>

    <div class="copyright-div">
        <?php if ($copyright): ?>
            <small class="copyright pull-left">© Dwellings, 2017, <?php print $copyright; ?></small>
        <?php endif; ?>
        <small class="pull-right">Design by Maria Osadcha, Developed by Geekhub geekhub.ck.ua<a href="#"><?php print t('^'); ?></a></small>
    </div>
  </div>
</footer>
