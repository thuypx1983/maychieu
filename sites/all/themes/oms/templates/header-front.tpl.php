<header >
    <div id="header-top">
        <div class="container">
            <div class="row">
                <div class="top-left">
                  <?php print render($page['header_top']); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="header-middle">
        <div class="container">
            <div class="row">
              <?php print render($page['header_middle']); ?>
            </div>
        </div>
    </div>
    <div id="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 hidden-sm hidden-xs desktop-menu">
                   <div class="menu-category-button">
                       <div class="icon-menu-category">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                       <a class="text-menu-category" href="javascript:void(0);">Danh mục sản phẩm</a>
                   </div>
                </div>
                <div class="col-md-9 col-lg-9 mobile-row">
                    <div class="button-mobile hidden-md hidden-lg">
                        <div class="menu-btn">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                    </div>
                  <?php print render($page['header']); ?>
                </div>
            </div>
        </div>
    </div>
</header>


<?php print $messages; ?>
<div class="clearfix"></div>