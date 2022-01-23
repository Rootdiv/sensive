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

/* Функция для вывода постов по количеству комментариев
--------------------------------------------------------
Параметры передаваемые функции (в скобках указано дефолтное значение):
post_num (10) = количество ссылок
format ('{date:j M Y}') = формат вывода даты поста
$days (5) = за последние n дней. Пример: $days=30 выведет посты за последние 30 дней или указываем год за который нужно вывести комментарии.
cache ('') = включить кеш (по умолчанию выключен), указываем 1, чтобы включить
*/
function most_commented_posts($post_num = 10, $format = '{date:j M Y}', $days = 5, $cache = '', $post_type = 'post') {
  global $wpdb;

  if ($cache) {
    $key = (string) md5($post_num . $format . $days . $post_type);
    if ($cache_out = wp_cache_get($key, __FUNCTION__)) {
      return $cache_out;
    }
  }

  if ($days) {
    $AND_days = "AND post_date > CURDATE() - INTERVAL $days DAY";
    if (strlen($days) == 4) {
      $AND_days = "AND YEAR(post_date)=" . trim($days);
    }

  }
  $sql = "SELECT ID, post_author, post_title, post_date, comment_count, guid
		FROM $wpdb->posts p
		WHERE post_status = 'publish' AND post_type = '$post_type' $AND_days
		ORDER BY comment_count DESC " .
    ($post_num ? " LIMIT $post_num" : '');
  $res = $wpdb->get_results($sql);

  if (!$res) {
    return false;
  }

  //Формировка вывода
  preg_match('!{date:(.*?)}!', $format, $date_m);

  $out = '';
  foreach ($res as $pst) {
    if ($pst->comment_count == 0) {
      continue;
    }
    $thumb_id = get_post_thumbnail_id($pst->ID); // прицепляем миниатюру
    $thumb_url = wp_get_attachment_image_src($thumb_id, 'medium'); // прицепляем миниатюру
    $title = esc_attr($pst->post_title);
    if ($date_m) {
      $replacement[$date_m[0]] = apply_filters('the_time', mysql2date($date_m[1], $pst->post_date));
    }

    $date = strtr($format, $replacement);

    $out .= '<div class="single-post-list">
      <div class="thumb">
        <img class="card-img rounded-0" src="'.$thumb_url[0].'" alt="">
        <ul class="thumb-info">
          <li>
            <a href="' . get_the_permalink($pst->ID) . '">
              ' . get_the_author_meta('display_name', $pst->post_author) . '
            </a>
          </li>
          <li>
            <a href="' . get_the_permalink($pst->ID) . '">' . $date . '</a>
          </li>
        </ul>
      </div>
      <div class="details mt-20">
        <a href="' . get_the_permalink($pst->ID) . '">
          <h6> ' . $title . ' </h6>
        </a>
      </div>
    </div>';
  }
  if (!$out) {
    return "<div>Нет записей с комментариями</div>";
  }

  if ($cache) {
    wp_cache_add($key, $out, __FUNCTION__);
  }

  return '<div class="popular-post-list">' . $out . '</div>';
}

add_shortcode( 'most_comment', 'most_comment_shortcode' );
function most_comment_shortcode($attrs){
  $attrs = shortcode_atts([
		'posts' => 5
	], $attrs);
	return most_commented_posts($attrs['posts'], '{date:j M}', 2022);
}

function move_field_to_bottom($fields) {
  $comment_field = $fields['comment'];
  $cookies_filed = $fields['cookies'];
  unset($fields['comment']);
  unset($fields['cookies']);
  $fields['comment'] = $comment_field;
  $fields['cookies'] = $cookies_filed;
  return $fields;
}
add_filter('comment_form_fields', 'move_field_to_bottom' );

//Склонение слов после числительных
function plural_form($number, $after) {
  $cases = array (2, 0, 1, 1, 1, 2);
  echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

//Шаблон для комментариев
class Bootstrap_Walker_Comment extends Walker {
  /**
   * What the class handles.
   *
   * @since 2.7.0
   * @var string
   *
   * @see Walker::$tree_type
   */
  public $tree_type = 'comment';

  /**
   * Database fields to use.
   *
   * @since 2.7.0
   * @var array
   *
   * @see Walker::$db_fields
   * @todo Decouple this
   */
  public $db_fields = array(
    'parent' => 'comment_parent',
    'id' => 'comment_ID',
  );

  /**
   * Starts the list before the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::start_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
   */
  public function start_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= '<ol class="children comment-list left-padding">' . "\n";
        break;
      case 'ul':
      default:
        $output .= '<ul class="children">' . "\n";
        break;
    }
  }

  /**
   * Ends the list of items after the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::end_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
   *                       Default empty array.
   */
  public function end_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= "</ol><!-- .children -->\n";
        break;
      case 'ul':
      default:
        $output .= "</ul><!-- .children -->\n";
        break;
    }
  }

  /**
   * Traverses elements to create list from elements.
   *
   * This function is designed to enhance Walker::display_element() to
   * display children of higher nesting levels than selected inline on
   * the highest depth level displayed. This prevents them being orphaned
   * at the end of the comment list.
   *
   * Example: max_depth = 2, with 5 levels of nested content.
   *     1
   *      1.1
   *        1.1.1
   *        1.1.1.1
   *        1.1.1.1.1
   *        1.1.2
   *        1.1.2.1
   *     2
   *      2.2
   *
   * @since 2.7.0
   *
   * @see Walker::display_element()
   * @see wp_list_comments()
   *
   * @param WP_Comment $element           Comment data object.
   * @param array      $children_elements List of elements to continue traversing. Passed by reference.
   * @param int        $max_depth         Max depth to traverse.
   * @param int        $depth             Depth of the current element.
   * @param array      $args              An array of arguments.
   * @param string     $output            Used to append additional content. Passed by reference.
   */
  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];
    $id = $element->$id_field;

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

    /*
     * If at the max depth, and the current element still has children, loop over those
     * and display them at this level. This is to prevent them being orphaned to the end
     * of the list.
     */
    if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
      foreach ($children_elements[$id] as $child) {
        $this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);
      }

      unset($children_elements[$id]);
    }
  }

  /**
   * Starts the element output.
   *
   * @since 2.7.0
   *
   * @see Walker::start_el()
   * @see wp_list_comments()
   * @global int        $comment_depth
   * @global WP_Comment $comment       Global comment object.
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment Comment data object.
   * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   * @param int        $id      Optional. ID of the current comment. Default 0 (unused).
   */
  public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;

    if (!empty($args['callback'])) {
      ob_start();
      call_user_func($args['callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }

    if ('comment' === $comment->comment_type) {
      add_filter('comment_text', array($this, 'filter_comment_text'), 40, 2);
    }

    if (('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) && $args['short_ping']) {
      ob_start();
      $this->ping($comment, $depth, $args);
      $output .= ob_get_clean();
    } elseif ('html5' === $args['format']) {
      ob_start();
      $this->html5_comment($comment, $depth, $args);
      $output .= ob_get_clean();
    } else {
      ob_start();
      $this->comment($comment, $depth, $args);
      $output .= ob_get_clean();
    }

    if ('comment' === $comment->comment_type) {
      remove_filter('comment_text', array($this, 'filter_comment_text'), 40);
    }
  }

  /**
   * Ends the element output, if needed.
   *
   * @since 2.7.0
   *
   * @see Walker::end_el()
   * @see wp_list_comments()
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment The current comment object. Default current comment.
   * @param int        $depth   Optional. Depth of the current comment. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   */
  public function end_el(&$output, $comment, $depth = 0, $args = array()) {
    if (!empty($args['end-callback'])) {
      ob_start();
      call_user_func($args['end-callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }
    if ('div' === $args['style']) {
      $output .= "</div><!-- #comment-## -->\n";
    } else {
      $output .= "</li><!-- #comment-## -->\n";
    }
  }

  /**
   * Outputs a pingback comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment The comment object.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function ping($comment, $depth, $args) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID();?>" <?php comment_class('', $comment);?>>
			<div class="comment-body">
				<?php _e('Pingback:');?> <?php comment_author_link($comment);?> <?php edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>');?>
			</div>
		<?php
  }

  /**
   * Filters the comment text.
   *
   * Removes links from the pending comment's text if the commenter did not consent
   * to the comment cookies.
   *
   * @since 5.4.2
   *
   * @param string          $comment_text Text of the current comment.
   * @param WP_Comment|null $comment      The comment object. Null if not found.
   * @return string Filtered text of the current comment.
   */
  public function filter_comment_text($comment_text, $comment) {
    $commenter = wp_get_current_commenter();
    $show_pending_links = !empty($commenter['comment_author']);

    if ($comment && '0' == $comment->comment_approved && !$show_pending_links) {
      $comment_text = wp_kses($comment_text, array());
    }

    return $comment_text;
  }

  /**
   * Outputs a single comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment Comment to display.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function comment($comment, $depth, $args) {
    if ('div' === $args['style']) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }

    $commenter = wp_get_current_commenter();
    $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

    if ($commenter['comment_author_email']) {
      $moderation_note = __('Your comment is awaiting moderation.');
    } else {
      $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
    }
    ?>
		<<?php echo $tag; ?> <?php comment_class($this->has_children ? 'parent' : '', $comment);?> id="comment-<?php comment_ID();?>">
		<?php if ('div' !== $args['style']): ?>
		<div id="div-comment-<?php comment_ID();?>" class="comment-body">
		<?php endif;?>
		<div class="comment-author vcard">
			<?php
    if (0 != $args['avatar_size']) {
      echo get_avatar($comment, $args['avatar_size']);
    }
    ?>
			<?php
    $comment_author = get_comment_author_link($comment);

    if ('0' == $comment->comment_approved && !$show_pending_links) {
      $comment_author = get_comment_author($comment);
    }

    printf(
      /* translators: %s: Comment author link. */
      esc_html__('%s <span class="says">says:</span>'),
      sprintf('<cite class="fn">%s</cite>', $comment_author)
    );
    ?>
		</div>
		<?php if ('0' == $comment->comment_approved): ?>
		<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
		<br />
		<?php endif;?>

		<div class="comment-meta commentmetadata">
			<?php
      printf(
        '<a href="%s">%s</a>',
        esc_url(get_comment_link($comment, $args)),
        sprintf(
          /* translators: 1: Comment date, 2: Comment time. */
          __('%1$s at %2$s'),
          get_comment_date('', $comment),
          get_comment_time()
        )
      );

      edit_comment_link(__('(Edit)'), ' &nbsp;&nbsp;', '');
      ?>
      </div>

      <?php
      comment_text(
        $comment,
        array_merge(
          $args,
          array(
            'add_below' => $add_below,
            'depth' => $depth,
            'max_depth' => $args['max_depth'],
          )
        )
      );
      ?>
      <?php
      comment_reply_link(
        array_merge(
          $args,
          array(
            'add_below' => $add_below,
            'depth' => $depth,
            'max_depth' => $args['max_depth'],
            'before' => '<div class="reply">',
            'after' => '</div>',
          )
        )
      );
      ?>
      <?php if ('div' !== $args['style']): ?>
		</div>
		<?php endif;?>
		<?php
  }

  /**
   * Outputs a comment in the HTML5 format.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment Comment to display.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function html5_comment($comment, $depth, $args) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';

    $commenter = wp_get_current_commenter();
    $show_pending_links = !empty($commenter['comment_author']);

    if ($commenter['comment_author_email']) {
      $moderation_note = __('Your comment is awaiting moderation.');
    } else {
      $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
    }
    ?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID();?>" class="comment-list" <?php comment_class($this->has_children ? 'parent' : '', $comment,);?>>
			<article id="div-comment-<?php comment_ID();?>" class="media comment-list single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
          <div class="thumb">
            <?php
            if (0 != $args['avatar_size']) {
              echo get_avatar($comment, $args['avatar_size'], 'mystery', '', array());
            }
            ?>
          </div>
          <div class="comment-meta desc">
            <div class="comment-author vcard">
              <?php
              $comment_author = get_comment_author_link($comment);

              if ('0' == $comment->comment_approved && !$show_pending_links) {
                $comment_author = get_comment_author($comment);
              }

              printf(
                /* translators: %s: Comment author link. */
                __('%s'),
                sprintf('<h5>%s</h5>', $comment_author)
              );
              ?>
            </div><!-- .comment-author -->

            <div class="comment-metadata">
              <?php
              printf(
                '<a href="%s" class="text-muted date"><time datetime="%s">%s</time></a>',
                esc_url(get_comment_link($comment, $args)),
                get_comment_time('c'),
                sprintf(
                  /* translators: 1: Comment date, 2: Comment time. */
                  __('%1$s at %2$s'),
                  get_comment_date('j F Y', $comment),
                  get_comment_time()
                )
              );

              edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>');
              ?>
            </div><!-- .comment-metadata -->

            <?php if ('0' == $comment->comment_approved): ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <?php endif;?>
            <div class="comment">
              <?php comment_text();?>
            </div><!-- .comment -->
          </div><!-- .comment-meta -->
        </div>
        <?php
          if ('1' == $comment->comment_approved || $show_pending_links) {
            comment_reply_link(
              array_merge(
                $args,
                array(
                  'add_below' => 'div-comment',
                  'depth' => $depth,
                  'max_depth' => $args['max_depth'],
                  'before' => '<div class="reply-btn btn-reply text-uppercase">',
                  'after' => '</div>',
                )
              )
            );
          }
        ?>
			</article><!-- .comment-body -->
		<?php
  }
}

//Регистрируем тип записи - туры
add_action('init', 'tour_custom_init');
function tour_custom_init() {
	register_post_type('tour', array(
		'labels'             => array(
			'name'               => 'Туры', // Основное название типа записи
      'singular_name'      => 'Тур', // отдельное название записи типа tour
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый тур',
			'edit_item'          => 'Редактировать тур',
			'new_item'           => 'Новый тур',
			'view_item'          => 'Посмотреть тур',
			'search_items'       => 'Найти тур',
			'not_found'          => 'Туров не найдено',
			'not_found_in_trash' => 'В корзине туров не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Туры',
    ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
    'menu_icon'          => 'dashicons-admin-site',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array('title','editor','author','thumbnail','excerpt', 'comments')
	));
}
