<?php

namespace Drupal\slick_views\Plugin\views\style;

/**
 * Slick style plugin.
 *
 * @ingroup views_style_plugins
 */
class SlickViews extends SlickViewsBase {

  /**
   * Overrides parent::buildOptionsForm().
   */
  public function options_form(&$form, &$form_state) {
    $definition = $this->getDefinedFormScopes();
    $this->buildSettingsForm($form, $definition);
  }

  /**
   * Overrides StylePluginBase::render().
   */
  public function render() {
    $settings = $this->buildSettings();
    $elements = [];

    foreach ($this->render_grouping($this->view->result, $settings['grouping']) as $rows) {
      $build = $this->buildElements($settings, $rows);

      // Supports Blazy formatter multi-breakpoint images if available.
      if (empty($settings['vanilla']) && !empty($build['items']) && isset($build['items'][0])) {
        $this->blazyManager()->isBlazy($settings, $build['items'][0]);
      }

      $build['settings'] = $settings;

      $elements = $this->manager()->build($build);
      unset($build);
    }

    return $elements;
  }

}
