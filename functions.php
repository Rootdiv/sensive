<?php
if (!function_exists('sensive_setup')) {
  function sensive_setup() {
    add_theme_support('custom-logo', [
      'height' => 26,
      'width' => 122,
      'flex-width' => false,
      'flex-height' => false,
      'header-text' => get_bloginfo('name'),
      'unlink-homepage-logo' => false, // WP 5.5
    ]);
    add_theme_support('html5', array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
      'script',
      'style',
    ));
    //Динамический <title>
    add_theme_support('title-tag');
    //Добавление миниатюр для постов и страниц
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(730, 340, true);
  }
}
add_action('after_setup_theme', 'sensive_setup');

//Подключение стилей и скриптов
add_action('wp_enqueue_scripts', 'sensive_scripts');
function sensive_scripts() {
  wp_enqueue_style('main', get_stylesheet_uri());
  //bootstrap css
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/bootstrap.min.css', array('main'));
  //fontawesome css
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/vendors/fontawesome/css/all.min.css', array('main'));
  //themify-icons css
  wp_enqueue_style('themify-icons', get_template_directory_uri() . '/vendors/themify-icons/themify-icons.css', array('main'));
  //linericon css
  wp_enqueue_style('linericon', get_template_directory_uri() . '/vendors/linericon/style.css', array('main'));
  //owl-carousel theme
  wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/vendors/owl-carousel/owl.theme.default.min.css', array('main'));
  //owl-carousel css
  wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.css', array('main'));
  wp_enqueue_style('sensive', get_template_directory_uri() . '/css/style.css', array('main'));

  //Переподключаем jQuery
  wp_register_script('jquery', get_template_directory_uri() . '/vendors/jquery-3.2.1.min.js');
  wp_enqueue_script('jquery');
  //Подключаем остальные скрипты
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/bootstrap.bundle.min.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('ajaxchimp', get_template_directory_uri() . '/js/jquery.ajaxchimp.min.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('mail-script', get_template_directory_uri() . '/js/mail-script.js', array('ajaxchimp'), '1.0.0', true);
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('ajaxchimp'), '1.0.0', true);
}

//Отключаем создание миниатюр файлов для указанных размеров
add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');
function delete_intermediate_image_sizes($sizes) {
  //размеры которые нужно удалить
  return array_diff($sizes, [
    'medium_large',
    'large',
    '1536x1536',
    '2048x2048',
  ]);
}

//Удаляем H2 из шаблона пагинации
function my_navigation_template($template, $class) {
  return '
  <nav class="navigation blog-pagination justify-content-center d-flex" role="navigation">
  <ul class="%1$s">%3$s</ul>
  </nav>
	';
}
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2);

//Функция для изменения email адреса
function devise_sender_email($original_email_address) {
  return 'info@maindiv.ru';
}

//Цепляем наши функции на фильтры WordPress
add_filter('wp_mail_from', 'devise_sender_email');

function my_phpmailer_config($phpmailer) {
	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.yandex.ru';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 465;
	require_once 'mail_config.php';
	$phpmailer->FromName = 'Wordpress Sensive';
}
add_action( 'phpmailer_init', 'my_phpmailer_config' );

//Регистрация меню
function sensive_menus() {
  $locations = array(
    'header' => 'Меню заголовка',
  );
  register_nav_menus($locations);
}
add_action('init', 'sensive_menus');

function band_digital_widgets_init() {
  register_sidebar(array(
    'name'          => 'Сайдбар блога',
    'id'            => 'sidebar-blog',
    'before_widget' => '<section id="%1$s" class="single-sidebar-widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="single-sidebar-widget__title">',
    'after_title'   => '</h4>'
  ));
  register_sidebar(array(
    'name'          => 'Соцсети',
    'id'            => 'social',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
  ));
  register_sidebar(array(
    'name'          => 'Сайдбар в подвале',
    'id'            => 'footer',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
  ));
}
add_action('widgets_init', 'band_digital_widgets_init');

function custom_nav_menu_css_class($classes) {
  //Добавляем к списку классов свой класс nav-item
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  $classes[] = 'nav-item';
  return $classes;
}
add_filter('nav_menu_css_class','custom_nav_menu_css_class', 10, 1);

function custom_nav_menu_link_attributes($attr) {
  $attr['class'] = 'nav-link';
  return $attr;
}
add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 1);
