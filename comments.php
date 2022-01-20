<?php
  if (post_password_required()) {
    return;
  }
?>

<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment!
	if (have_comments()) {?>
    <?php the_comments_navigation();?>
    <ol class="comment-list">
      <h4>
        <?php plural_form(get_comments_number(),
        /* варианты написания для количества 1, 2 и 5 */
        array('Комментарий', 'Комментария', 'Комментариев'));?>
        </h4>
      <?php wp_list_comments([
        'walker'            => new Bootstrap_Walker_Comment(), //какой шаблон использовать
        'max_depth'         => '2', //Максимальная вложенность
        'style'             => 'ol', //во что оборачиваем комменты
        'type'              => 'all',
        'reply_text'        => 'Ответить',
        'per_page'          => '10',
        'avatar_size'       => 60,
        'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
        'echo'              => true,     // true или false
      ]);?>
		</ol><!-- .comment-list -->
  <?php
  the_comments_navigation();

  // If comments are closed and there are comments, let's leave a little note, shall we?
  if (!comments_open()) { ?>
      <p class="no-comments">Комментарии закрыты</p>
    <?php
  };
} // Check for have_comments().?>
</div><!-- #comments -->
<div class="comment-form"><?php
  $defaults = [
    'fields' => [
      '<div class="form-group form-inline">',
        'author' => '<div class="form-group col-lg-6 col-md-6 name">
          <input id="author" name="author" type="text" class="form-control" placeholder="Имя"
            value="' . esc_attr($commenter['comment_author']) . '" size="30"
            onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'Enter Name\'" />
        </div>',
        'email'  => '<div class="form-group col-lg-6 col-md-6 email">
          <input id="email" name="email" type="email" class="form-control" placeholder="Email"
            value="' . esc_attr( $commenter['comment_author_email']) . '" size="30" aria-describedby="email-notes"
            onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'Enter Name\'" />
        </div>',
      '</div>',
      'subject'  => '<div class="form-group">
        <input id="subject" name="subject" type="text" class="form-control" placeholder="Тема"
          value="' . esc_attr( $commenter['comment_author_email']) . '" size="30" aria-describedby="email-notes"
          onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'Тема\'" />
      </div>',
      'cookies' => '<div class="comment-form-cookies-consent d-flex">' .
        sprintf( '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="mr-3"
          type="checkbox" value="yes"%s />', @$consent ) . '
        <label for="wp-comment-cookies-consent">
          Сохраните мое имя, адрес электронной почты и веб-сайт в этом браузере для следующего комментария.
        </label>
      </div>',
    ],
    'comment_field'        => '<div class="form-group">
      <textarea id="comment" name="comment" rows="5" class="form-control mb-10" placeholder="Сообщение"
        aria-required="true" onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'Тема\'" required="required"></textarea>
    </div>',
    'must_log_in'          => '<div class="must-log-in mb-3">' .
      sprintf('Вам необходимо <a href="%s">войти в систему</a>, чтобы оставить комментарий.',
      wp_login_url(apply_filters('the_permalink', get_permalink($post->ID)))) . '
    </div>',
    'logged_in_as'         => '<div class="logged-in-as mb-3">' .
      sprintf('<a href="%1$s" aria-label="Вы вошли как %2$s.">Вы вошли как %2$s</a>. <a href="%3$s">Выйти?</a>',
      get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post->ID)))) . '
    </div>',
    'comment_notes_before' => '<div class="comment-notes mb-4">
      <span id="email-notes">Ваш e-mail защищён от спама </span>
    </div>',
    'comment_notes_after'  => '',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'class_form'           => '',
    'class_submit'         => 'submit button submit_btn',
    'name_submit'          => 'submit',
    'title_reply'          => 'Оставьте ответ',
    'title_reply_to'       => 'Ответить %s',
    'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
    'title_reply_after'    => '</h3>',
    'cancel_reply_before'  => ' <small>',
    'cancel_reply_after'   => '</small>',
    'cancel_reply_link'    => 'Отменить оправку',
    'label_submit'         => 'Отправить комментарий',
    'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
    'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
    'format'               => 'html5',
  ];
  comment_form($defaults);?>
</div>
