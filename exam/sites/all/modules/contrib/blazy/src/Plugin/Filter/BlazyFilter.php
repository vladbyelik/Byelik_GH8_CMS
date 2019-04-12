<?php

namespace Drupal\blazy\Plugin\Filter;

use Drupal\blazy\Blazy;
use Drupal\blazy\BlazyDefault;
use Drupal\blazy\BlazyManagerInterface;
use Drupal\blazy\Plugin\Field\FieldFormatter\BlazyVideoTrait;

/**
 * Provides a filter to lazyload image, or iframe elements.
 */
class BlazyFilter {

  use BlazyVideoTrait;

  /**
   * The blazy manager service.
   *
   * @var \Drupal\blazy\BlazyManagerInterface
   */
  protected $manager;

  /**
   * Constructs the BlazyFilter object.
   */
  public function __construct(BlazyManagerInterface $manager) {
    $this->manager = $manager;
  }

  /**
   * Return blazy filter info.
   */
  public function filterInfo() {
    $filters['blazy_filter'] = [
      'title'             => t('Lazyload inline images, or video iframes, using Blazy'),
      'cache'             => TRUE,
      'process callback'  => '_blazy_filter_process',
      'settings callback' => '_blazy_filter_settings_form',
      'tips callback'     => '_blazy_filter_tips',
      'weight'            => 3,
      'default settings'  => [
        'filter_tags'  => ['img' => 'img', 'iframe' => 'iframe'],
        'column'       => TRUE,
        'grid'         => TRUE,
        'media_switch' => '',
      ],
    ];

    return $filters;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $filter, $langcode) {
    $allowed_tags = array_values((array) $filter->settings['filter_tags']);
    if (empty($allowed_tags)) {
      return $text;
    }

    $dom = filter_dom_load($text);
    $settings = BlazyDefault::lazySettings();
    $settings['grid'] = stristr($text, 'data-grid') !== FALSE;
    $settings['column'] = stristr($text, 'data-column') !== FALSE;
    $settings['media_switch'] = $switch = $filter->settings['media_switch'];
    $settings['lightbox'] = ($switch && in_array($switch, $this->manager->getLightboxes())) ? $switch : FALSE;
    $settings['id'] = $settings['gallery_id'] = 'blazy-filter-' . drupal_random_key(8);
    $settings['plugin_id'] = 'blazy_filter';
    $settings['_grid'] = $settings['column'] || $settings['grid'];
    $settings['placeholder'] = $this->manager->config('placeholder');

    // At D7, BlazyFilter can only attach globally, prevents blocking.
    // Allows lightboxes to provide its own optionsets.
    if ($switch) {
      $settings[$switch] = empty($settings[$switch]) ? $switch : $settings[$switch];
    }

    // Provides alter like formatters to modify at one go, even clumsy here.
    $build = ['settings' => $settings];
    drupal_alter('blazy_settings', $build, $filter);
    $settings = array_merge($settings, $build['settings']);

    $elements = $grid_nodes = [];
    foreach ($allowed_tags as $allowed_tag) {
      $nodes = $dom->getElementsByTagName($allowed_tag);
      if ($nodes->length > 0) {
        $item_settings = $settings;
        $item_settings['count'] = $nodes->length;
        foreach ($nodes as $delta => $node) {
          if ($node->hasAttribute('data-unblazy')) {
            continue;
          }

          // Build Blazy elements with lazyloaded image, or iframe.
          $item_settings['delta'] = $delta;
          $this->buildSettings($item_settings, $node, $filter);

          $build = ['settings' => $item_settings];
          $this->buildImageItem($build, $node);

          // @todo remove as this was D8 specific, not available at D7 ckeditor?
          // Sanitization was done by Caption filter when arriving here, as
          // otherwise we cannot see this figure, yet provide fallback.
          if ($node->parentNode->tagName === 'figure') {
            $caption = $node->parentNode->getElementsByTagName('figcaption');
            if ($caption->length > 0 && $caption->item(0) && $text = $caption->item(0)->nodeValue) {
              $build['captions']['alt'] = ['#markup' => filter_xss($text, BlazyDefault::TAGS)];

              // Marks figures for removal as its contents are moved into grids.
              if ($settings['_grid']) {
                $node->parentNode->setAttribute('class', 'blazy-figure-removed');
              }
            }
          }

          $output = $this->manager->getBlazy($build);
          if ($settings['_grid']) {
            $elements[] = $output;
            $grid_nodes[] = $node;
          }
          else {
            $altered_html = drupal_render($output);

            // Load the altered HTML into a new DOMDocument, retrieve element.
            $updated_nodes = filter_dom_load($altered_html)->getElementsByTagName('body')
              ->item(0)
              ->childNodes;

            foreach ($updated_nodes as $updated_node) {
              // Import the updated from the new DOMDocument into the original
              // one, importing also the child nodes of the updated node.
              $updated_node = $dom->importNode($updated_node, TRUE);
              $node->parentNode->insertBefore($updated_node, $node);
            }

            // Finally, remove the original blazy node.
            $node->parentNode->removeChild($node);
          }
        }
      }
    }

    if ($settings['_grid'] && !empty($elements[0])) {
      $settings['first_uri'] = isset($elements[0]['#build']['settings']['uri']) ? $elements[0]['#build']['settings']['uri'] : '';
      $this->buildGrid($dom, $settings, $elements, $grid_nodes);
    }

    $text = filter_dom_serialize($dom);

    return trim($text);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($filter, $long = FALSE) {
    if ($long) {
      $tips = t('<p><strong>Blazy</strong>: Image or iframe is lazyloaded. To disable, add attribute <code>data-unblazy</code>:</p>
      <ul>
          <li><code>&lt;img data-unblazy /&gt;</code></li>
          <li><code>&lt;iframe data-unblazy /&gt;</code></li>
      </ul>');

      if ($filter->settings['grid'] || $filter->settings['column']) {
        if ($filter->settings['grid']) {
          $tips .= t('<p>To build a grid of images/ videos, add attribute <code>data-grid</code> (only to the first item):
          <ul>
              <li>For images: <code>&lt;img data-grid="1 3 4" /&gt;</code></li>
              <li>For videos: <code>&lt;iframe data-grid="1 3 4" /&gt;</code></li>
              <li>If both media types are present, choose only the first item.</li>
          </ul>');
        }
        if ($filter->settings['column']) {
          $tips .= t('<p>To build a CSS3 Masonry columns of images/ videos, add attribute <code>data-column</code> (only to the first item):
          <ul>
              <li>For images: <code>&lt;img data-column="1 3 4" /&gt;</code></li>
              <li>For videos: <code>&lt;iframe data-column="1 3 4" /&gt;</code></li>
              <li>If both media types are present, choose only the first item.</li>
          </ul>');
        }

        $tips .= t('The numbers represent the amount of grids/ columns for small, medium and large devices respectively, space delimited. Be aware! All media items will be grouped regardless of their placements, unless those disabled via <code>data-unblazy</code>. This is also required if using <b>Image to lightbox</b> (Colorbox, Photobox, PhotoSwipe). Only one block of grids or columns can exist at a time in a particular body text.</p>');
      }

      return $tips;
    }
    else {
      return t('To disable lazyload, add attribute <code>data-unblazy</code> to <code>&lt;img&gt;</code> or <code>&lt;iframe&gt;</code> elements. Examples: <code>&lt;img data-unblazy</code> or <code>&lt;iframe data-unblazy</code>.');
    }
  }

  /**
   * Build the grid.
   *
   * @param \DOMDocument $dom
   *   The HTML DOM object being modified.
   * @param array $settings
   *   The settings array.
   * @param array $elements
   *   The renderable array of blazy item.
   * @param array $grid_nodes
   *   The grid nodes.
   */
  private function buildGrid(\DOMDocument &$dom, array &$settings, array $elements = [], array $grid_nodes = []) {
    $xpath = new \DOMXPath($dom);
    $query = $settings['style'] = $settings['column'] ? 'column' : 'grid';
    $grid = FALSE;

    // This is weird, variables not working for xpath?
    $node = $query == 'column' ? $xpath->query('//*[@data-column]') : $xpath->query('//*[@data-grid]');
    if ($node->length > 0 && $node->item(0) && $node->item(0)->hasAttribute('data-' . $query)) {
      $grid = $node->item(0)->getAttribute('data-' . $query);
    }

    if ($grid) {
      // Create the parent grid container, and put it before the first.
      $grids = array_map('trim', explode(' ', $grid));

      foreach (['small', 'medium', 'large'] as $key => $item) {
        if (isset($grids[$key])) {
          $settings['grid_' . $item] = $grids[$key];
          $settings['grid'] = $grids[$key];
        }
      }

      $build = [
        'items' => $elements,
        'settings' => $settings,
      ];

      $output = $this->manager->build($build);
      $altered_html = drupal_render($output);

      if (($first = $grid_nodes[0]) && $grid) {
        // Create the parent grid container, and put it before the first.
        $container = $first->parentNode->insertBefore($dom->createElement('div'), $first);
        $updated_nodes = filter_dom_load($altered_html)->getElementsByTagName('body')
          ->item(0)
          ->childNodes;

        // This extra container ensures hook_blazy_build_alter() aint screw up.
        $container->setAttribute('class', 'blazy-wrapper blazy-wrapper--filter');
        foreach ($updated_nodes as $updated_node) {
          // Import the updated from the new DOMDocument into the original
          // one, importing also the child nodes of the updated node.
          $updated_node = $dom->importNode($updated_node, TRUE);
          $container->appendChild($updated_node);
        }

        // Cleanups old nodes already moved into grids.
        foreach ($grid_nodes as $node) {
          $node->parentNode->removeChild($node);
        }

        // Cleanups marked figures since its contents were moved into grids.
        $figures = $xpath->query("//*[contains(@class, 'blazy-figure-removed')]");
        if ($figures->length > 0) {
          foreach ($figures as $figure) {
            $figure->parentNode->removeChild($figure);
          }
        }
      }
    }
  }

  /**
   * Returns the faked image item for the image, uploaded or hard-coded.
   *
   * @param array $build
   *   The content array being modified.
   * @param object $node
   *   The HTML DOM object.
   */
  private function buildImageItem(array &$build, $node) {
    $settings = &$build['settings'];
    $item = new \stdClass();
    $item->uri = $settings['uri'];

    // Responsive image with aspect ratio requires an extra container to work
    // with Align/ Caption images filters.
    $build['media_attributes']['class'][] = 'media-wrapper media-wrapper--blazy';
    // Copy all attributes of the original node to the $item _attributes.
    if ($node->attributes->length) {
      foreach ($node->attributes as $attribute) {
        if ($attribute->nodeName == 'src') {
          continue;
        }

        // Move classes (align-BLAH,etc) to Blazy container, not image so to
        // work with alignments and aspect ratio.
        if ($attribute->nodeName == 'class') {
          $build['media_attributes']['class'][] = $attribute->nodeValue;
        }
        else {
          $build['item_attributes'][$attribute->nodeName] = $attribute->nodeValue;
        }
      }

      $build['media_attributes']['class'] = array_unique($build['media_attributes']['class']);
    }

    $build['item'] = $item;
  }

  /**
   * Returns the settings for the current $node.
   *
   * @param array $settings
   *   The settings being modified.
   * @param object $node
   *   The HTML DOM object.
   * @param object $filter
   *   The filter object.
   */
  private function buildSettings(array &$settings, $node, $filter) {
    $src = $node->getAttribute('src');
    $width = $node->getAttribute('width');
    $height = $node->getAttribute('height');
    $src = drupal_strip_dangerous_protocols($src);

    if ($src && $node->tagName == 'img') {
      $abs_url = strpos($src, 'http') === FALSE ? DRUPAL_ROOT . $src : $src;
      if (!$width && $data = @getimagesize($abs_url)) {
        list($width, $height) = $data;
      }
    }

    $settings['ratio'] = !$width ? '' : 'fluid';
    $settings['uri'] = $settings['image_url'] = $src;
    if ($node->tagName == 'iframe') {
      $settings['input_url'] = $src;
      $settings['uri'] = $settings['image_url'] = $this->getVideoThumbnail($src);
      $settings['scheme'] = $this->getHost($src);
      $settings['embed_url'] = $this->getVideoEmbedUrl($src);
      $settings['autoplay_url'] = $this->getAutoplayUrl($src);
      $settings['ratio'] = !$width ? '16:9' : 'fluid';
      $settings['type'] = 'video';
    }

    // Gets the correct URI if applicable.
    if (!empty($settings['image_url']) && $uri = Blazy::buildUri($settings['image_url'])) {
      $settings['uri'] = $uri;
    }

    $settings['blazy'] = TRUE;
    $settings['lazy'] = 'blazy';
    $settings['width'] = $width;
    $settings['height'] = $height;
  }

  /**
   * Implements callback_filter_settings().
   */
  public function settingsForm($form, &$form_state, $filter) {
    $lightboxes = $this->manager->getLightboxes();

    $elements['filter_tags'] = [
      '#type' => 'checkboxes',
      '#title' => t('Enable HTML tags'),
      '#options' => [
        'img' => t('Image'),
        'iframe' => t('Video iframe'),
      ],
      '#default_value' => empty($filter->settings['filter_tags']) ? [] : array_values((array) $filter->settings['filter_tags']),
      '#description' => t('To disable per item, add attribute <code>data-unblazy</code>.'),
    ];

    $elements['grid'] = [
      '#type' => 'checkbox',
      '#title' => t('Grid Foundation'),
      '#default_value' => $filter->settings['grid'],
    ];

    $elements['column'] = [
      '#type' => 'checkbox',
      '#title' => t('CSS3 Masonry columns'),
      '#default_value' => $filter->settings['column'],
      '#description' => t('Check to support inline grids, or columns. Load both to support any, yet only one can exist at a time in a particular body text.'),
    ];

    $elements['media_switch'] = [
      '#type' => 'select',
      '#title' => t('Media switcher'),
      '#options' => [
        'media' => t('Image to iframe'),
      ],
      '#empty_option' => t('- None -'),
      '#default_value' => $filter->settings['media_switch'],
      '#description' => t('<ul><li><b>Image to iframe</b> will hide iframe behind image till toggled.</li><li><b>Image to lightbox</b> (Colorbox, Photobox, PhotoSwipe, Intense, etc.) requires a grid. Add <code>data-column="1 3 4"</code> or <code>data-grid="1 3 4"</code> to the first image/ iframe only.</li></ul>'),
      '#suffix' => t('Check out <a href="@url1">filter tips</a> for details. Be sure to configure Blazy pages <a href="@url2">here</a>.', [
        '@url1' => url('filter/tips', ['fragment' => 'filter-blazy_filter']),
        '@url2' => url('admin/config/media/blazy', ['fragment' => 'edit-visibility']),
      ]),
    ];

    if (!empty($lightboxes)) {
      foreach ($lightboxes as $lightbox) {
        $name = ucwords(str_replace('_', ' ', $lightbox));
        $elements['media_switch']['#options'][$lightbox] = t('Image to @lightbox', ['@lightbox' => $name]);
      }
    }

    return $elements;
  }

  /**
   * Submit handler for hook_filter_admin_format_form_alter().
   *
   * The hustle is due to non-bubbleable cache metadata at D7, needs to catch
   * at least the enabled settings without querying database.
   */
  public function submitForm($form, &$form_state) {
    $defaults = BlazyDefault::formSettings()['filters'];
    if (isset($form_state['values']['filters']['blazy_filter'])) {
      $blazy = $form_state['values']['filters']['blazy_filter'];
      if ($blazy['status'] == 1) {
        $format = $form_state['values']['format'];
        $settings = &$blazy['settings'];
        $components['filters'] = $this->manager->config('filters', []);
        foreach ($defaults as $key => $value) {
          if (isset($settings[$key])) {
            $type = gettype($value);
            settype($settings[$key], $type);

            $components['filters'][$format][$key] = $settings[$key];
          }
        }

        // Merge individual flat variables into a single blazy.settings.
        variable_set('blazy.settings', array_merge((array) $this->manager->config(), $components));
      }
    }
  }

}
