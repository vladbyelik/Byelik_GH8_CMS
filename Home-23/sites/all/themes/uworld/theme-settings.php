<?php
/**
 * @file
 * Theme settings.
 */

/**
 * Implements theme_settings().
 */
function uworld_form_system_theme_settings_alter(&$form, &$form_state) {
  // Ensure this include file is loaded when the form is rebuilt from the cache.
  $form_state['build_info']['files']['form'] = drupal_get_path('theme', 'uworld') . '/theme-settings.php';

  // Add theme settings here.
  $form['uworld_theme_settings'] = array(
    '#title' => t('Theme Settings'),
    '#type' => 'fieldset',
  );

  // Copyright.
  $copyright = theme_get_setting('copyright');
  $form['uworld_theme_settings']['copyright'] = array(
    '#title' => t('Copyright'),
    '#type' => 'text_format',
    '#format' => $copyright['format'],
    '#default_value' => $copyright['value'] ? $copyright['value'] : t('Drupal is a registered trademark of Dries Buytaert.'),
  );

  // Return the additional form widgets.

    // header
    $form['uworld_settings']['header'] = array(
        '#type' => 'fieldset',
        '#title' => t('Header'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );

    $form['uworld_settings']['header']['header_heading'] = array(
        '#type' => 'textfield',
        '#title' => t('Headline'),
        '#default_value' => theme_get_setting('header_heading', 'uworld'),
    );

    $form['uworld_settings']['header']['header_caption'] = array(
        '#type' => 'textarea',
        '#title' => t('Caption'),
        '#default_value' => theme_get_setting('header_caption', 'uworld'),
    );

    $form['uworld_settings']['header']['header_link'] = array(
        '#type' => 'textfield',
        '#title' => t('Link name'),
        '#default_value' => theme_get_setting('header_link', 'uworld'),
    );

  return $form;
}
