<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="<?=get_template_directory_uri();?>/img/favicon.png" type="image/png" />
    <?php wp_head();?>
  </head>
  <body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container box_1620">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php $logo_img = ''; $home = '';
            if(!is_front_page()){
              $home = ' href="' . home_url('/') . '"';
            }
            if ($custom_logo_id = get_theme_mod('custom_logo')) {
              $logo_img = wp_get_attachment_image($custom_logo_id, 'full', false, array(
                'alt' => get_bloginfo('name'),
              ));
            }
            if (has_custom_logo()) {
              echo '<a' . $home . ' class="navbar-brand logo_h">' . $logo_img . '</a>';
            } else {
              echo '<a' . $home . ' class="navbar-brand logo_h">
                <span>' . get_bloginfo('name') . '</span>
              </a>';
            }?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
              <?php wp_nav_menu([
              'theme_location'  => 'header',
              'container'       => false,
              'menu_class'      => 'nav navbar-nav menu_nav justify-content-center',
              'menu_id'         => false,
              'echo'            => true,
              'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            ]);?>

              <ul class="nav navbar-nav navbar-right navbar-social">
                <?php if (!dynamic_sidebar('social')) : dynamic_sidebar('social'); endif; ?>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
