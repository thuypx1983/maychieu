<?php

/**
 * @file
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Default keys within $info_split:
 * - $info_split['module']: The module that implemented the search query.
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 *
 * Other variables:
 * - $classes_array: Array of HTML class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $title_attributes_array: Array of HTML attributes for the title. It is
 *   flattened into a string within the variable $title_attributes.
 * - $content_attributes_array: Array of HTML attributes for the content. It is
 *   flattened into a string within the variable $content_attributes.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for its existence before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 * @code
 *   <?php if (isset($info_split['comment'])): ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 * @endcode
 *
 * To check for all available data within $info_split, use the code below.
 * @code
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 * @endcode
 *
 * @see template_preprocess()
 * @see template_preprocess_search_result()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<li class="<?php print $classes; ?> col-md-3 col-lg-3 col-sm-6 col-xs-6 product-item"<?php print $attributes; ?> >
    <div class="row-content">
      <?php
      $field = field_get_items('node', $result['node'], 'uc_product_image');
      if($field){
        ?>
          <div class="views-field views-field-uc-product-image">
              <div class="field-content">
                  <a href="<?php echo url('node/'.$result['node']->nid)?>">
                      <img typeof="foaf:Image" src="<?php echo image_style_url('style_255x255', $field[0]['uri'])?>" alt="" width="255" height="255">
                  </a>
              </div>
          </div>
        <?php
      }

      ?>
        <div class="views-field views-field-title">
            <span class="field-content"><a href="<?php echo url('node/'.$result['node']->nid)?>"><?php echo $result['node']->title?></a></span>
        </div>
      <?php
      if($result['node']->type=='product'){
        $variant = empty($result['node']->variant) ? _uc_product_get_variant($result['node']) : $result['node'];
        //print render(field_view_field('node', $result['node'], 'uc_product_cost', array('label'=>'hidden')));
        $cost=array(
          '#theme' => 'uc_product_price',
          '#title' => '',
          '#value' => $variant->cost,
          '#attributes' => array(
            'class' => array(
              'cost',
              'uc-product-' . $result['node']->nid,
            ),
          ),
          '#access' => user_access('administer products'),
        );
        print render($cost);

        $sell_price=array(
          '#theme' => 'uc_product_price',
          '#title' => '',
          '#value' => $variant->sell_price,
          '#attributes' => array(
            'class' => array(
              'sell-price',
            ),
          ),
        );
        print render($sell_price);
        print render(field_view_field('node', $result['node'], 'field_discount', array('label'=>'hidden')));
      }
     ?>
    </div>
</li>
