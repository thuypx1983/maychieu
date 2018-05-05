<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>


<div id="wrap">
  <?php
  include(drupal_get_path('theme', 'oms').'/templates/header-front.tpl.php');
  ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 hidden-sm hidden-xs">
                <!-- start main-menu -->
                <nav id="navigation" class="clearfix" role="navigation">
                    <div id="main-menu">
                      <?php
                      if (module_exists('i18n_menu')) {
                        $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
                      } else {
                        $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
                      }
                      print drupal_render($main_menu_tree);
                      ?>
                    </div>
                </nav><!-- end main-menu -->
            </div>
            <div class="col-md-9 col-lg-9">
                <div class="row">
                  <?php if ($page['home_banner']): ?>
                      <div id="home-banner"> <?php print render($page['home_banner']); ?></div>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

      <?php if ($page['home_block_1']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_1']); ?>
        </div>
      <?php endif; ?>
    <?php if ($page['home_block_2']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_2']); ?>
        </div>
    <?php endif; ?>
    <?php if ($page['home_block_3']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_3']); ?>
        </div>
    <?php endif; ?>
    <?php if ($page['home_block_4']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_4']); ?>
        </div>
    <?php endif; ?>
    <?php if ($page['home_block_5']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_5']); ?>
        </div>
    <?php endif; ?>
    <?php if ($page['home_block_6']): ?>
        <div class="container product-sales-off home-high3">
            <?php print render($page['home_block_6']); ?>
        </div>
    <?php endif; ?>



    <div class="container home-high5">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <?php
                if ($page['home_high5_left']):
                    print render($page['home_high5_left']);
                endif;
                ?>
            </div>
            <div class="col-md-6 col-lg-6">

                <?php
                if ($page['home_high5_right']):
                    print render($page['home_high5_right']);
                endif;
                ?>
            </div>

        </div>
    </div>

    <?php if ($page['home_high7']): ?>
        <div class="container">
            <?php print render($page['home_high7']); ?>
        </div>
    <?php endif; ?>

    <div class="container home-high6">
        <?php
        if ($page['home_high6']):
            print render($page['home_high6']);
        endif;
        ?>
    </div>

  <?php
  include(drupal_get_path('theme', 'oms').'/templates/footer.tpl.php');
  ?>

</div>
