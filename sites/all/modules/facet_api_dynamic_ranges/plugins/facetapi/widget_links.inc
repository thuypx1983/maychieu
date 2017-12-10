<?php

/**
 * @file
 * Widgets for facets rendered as test link ranges.
 */

/**
 * Widget that renders facets as a list of clickable links.
 *
 * Links make it easy for users to narrow down their search results by clicking
 * on them. The render arrays use theme_item_list() to generate the HTML markup.
 */
class FacetapiDynamicRangesWidgetLinks extends FacetapiWidgetLinks {

  /**
   * Renders the links.
   */
  public function execute() {
    $element = &$this->build[$this->facet['field alias']];

    // Get Search API stuff.
    $searcher = $this->facet->getAdapter()->getSearcher();
    $index_id = explode('@', $searcher);
    $index = search_api_index_load($index_id[1]);
    list($query,) = $this->facet->getAdapter()->getCurrentSearch();

    $range_field = $this->facet['field alias'];

    // Get facet path field/alias
    if (module_exists('facetapi_pretty_paths')) {
      $processor = new FacetapiUrlProcessorPrettyPaths($this->facet->getAdapter());
      $range_field = $processor->getFacetPrettyPathsAlias($this->facet->getFacet());
    };

    // Prepare variables for min/max query.
    $variables = array(
      'element' => $element,
      'index' => $index,
      'range_field' => $range_field,
      'target' => $this->facet->getAdapter()->getSearchPath(),
      'query' => $query,
      'prefix' => $this->settings->settings['prefix'],
      'suffix' => $this->settings->settings['suffix'],
    );

    // Generate the ranges to the be used for the text links.
    $element = facet_api_dynamic_ranges_generate_facet_ranges($variables);

    // Replace ':' with '/'.
    if (module_exists('facetapi_pretty_paths')) {
      foreach ($element as $key => $e) {
        if (isset($e['#query']['f'])) {
          $element[$key]['#query']['f'] = str_replace(':', '/', $e['#query']['f']);
          if (isset($e['#path']) && isset($element[$key]['#query']['f'][0]) && substr_count($e['#path'], '/' . $element[$key]['#query']['f'][0]) > 0) {
            $element[$key]['#active'] = TRUE;
            $element[$key]['#path'] = str_replace('/' . $element[$key]['#query']['f'][0], '', $e['#path']);
            unset($element[$key]['#query']['f']);
          }
        }
      }
    }

    // Sets each item's theme hook, builds item list.
    $this->setThemeHooks($element);

    $items_build = $this->buildListItems($element);

    // Replace ?f[0]= with /
    if (module_exists('facetapi_pretty_paths')) {
      foreach ($items_build as $key => $build) {
        $items_build[$key]['data'] = str_replace('?f[0]=', '/', $build['data']);
      }
    }

    $element = array(
      '#theme' => 'item_list',
      '#items' => $items_build,
      '#attributes' => $this->build['#attributes'],
    );
  }

}

/**
 * Widget that renders facets as a list of clickable checkboxes.
 *
 * This widget renders facets in the same way as FacetapiWidgetLinks but uses
 * JavaScript to transform the links into checkboxes followed by the facet.
 */
class FacetapiDynamicRangesWidgetCheckboxLinks extends FacetapiDynamicRangesWidgetLinks {

  /**
   * Overrides FacetapiWidgetLinks::init().
   *
   * Adds additional JavaScript settings and CSS.
   */
  public function init() {
    parent::init();
    $this->jsSettings['makeCheckboxes'] = 1;
    drupal_add_css(drupal_get_path('module', 'facetapi') . '/facetapi.css');
  }

  /**
   * Overrides FacetapiWidgetLinks::getItemClasses().
   *
   * Sets the base class for checkbox facet items.
   */
  public function getItemClasses() {
    return array('facetapi-checkbox');
  }
}
