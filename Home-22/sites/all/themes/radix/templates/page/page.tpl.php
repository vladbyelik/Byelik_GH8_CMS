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
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
            <?php if ($site_name || $logo): ?>
<!--            <a href="--><?php //print $front_page; ?><!--" class="navbar-brand" rel="home" title="--><?php //print t('Home'); ?><!--">-->
                <?php if ($logo): ?>
                <img class="logo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo" />
                <?php endif; ?>
                    <?php if ($site_name): ?>
                        <span class="site-name"><?php print $site_name; ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div> <!-- /.navbar-header -->
        <div class="social-icons">
            <i><a class="icon-facebook" href="#"></a></i>
            <i><a class="icon-twitter" href="#"></a></i>
            <i><a class="icon-instagram" href="#"></a></i>
            <i><a class="icon-gplus" href="#"></a></i>
            <i><a class="icon-post" href="#"></a></i>
        </div>
    </nav><!-- /.navbar -->
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
    <div id="content" class="container">
      <?php print render($page['content']); ?>
    </div>
  </div> <!-- /#main -->
</div> <!-- /#main-wrapper -->
<footer id="footer" class="footer" role="footer">
  <div class="container">
      <div class="pull-right"><i><a class="icon-up-open-big" href="#"></a></i></div>
    <?php if ($copyright): ?>
        <span class="copyright pull-left">Created by 2ndself.com, with<i class="icon-heart"></i><br>exclusive for theuncreativelab.com</span>
        <span class="copyright pull-left">© 2014 Square. All Rights Reserved.</span>
    <?php endif; ?>
  </div>
</footer>
