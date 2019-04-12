<?php

/**
 * @file
 * Uworld theme implementation to display a node.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>

<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>
        <div class="div">
            <div class="custom-tabs">
                <header>
                    <div class="custom-tab-head">
                        Description
                    </div>
                    <div class="custom-tab-head">
                        Updates
                    </div>
                    <div class="custom-tab-head active">
                        Donors
                    </div>
                    <div class="custom-tab-head">
                        Map
                    </div>
                </header>
                <div class="custom-tab-contents">
                    <div class="custom-tab-content">
                        Content of description
                    </div>
                    <div class="custom-tab-content">
                        Content of updates
                    </div>
                    <div class="custom-tab-content active">
                        <ul>
                            <li>
                                <span>Jill Anderson</span>
                                <div class="donate">
                                    <span class="money">$500</span>
                                    <span class="time">27 mins ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Virginia Bagby</span>
                                <div class="donate">
                                    <span class="money">$1 500</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Melissa Patton</span>
                                <div class="donate">
                                    <span class="money">$2 300</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Anonymous Donor</span>
                                <div class="donate">
                                    <span class="money">$50</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Melissa Patton</span>
                                <div class="donate">
                                    <span class="money">$500</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Anonymous Donor</span>
                                <div class="donate">
                                    <span class="money">$500</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Melissa Patton</span>
                                <div class="donate">
                                    <span class="money">$100</span>
                                    <span class="time">3 days ago</span>
                                </div>
                            </li>

                            <li>
                                <span>Anonymous Donor</span>
                                <div class="donate">
                                    <span class="money">$40</span>
                                    <span class="time">3 days ago</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="custom-tab-content">
                        Content of map
                    </div>
                </div>
            </div>
            <div class="build-link">
                <span>You can build a home for a family in need</span>
                <div class="link"><a href="#">Get involved</a></div>
            </div>
        </div>
