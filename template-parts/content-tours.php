<div class="col-lg-8">
  <?php global $post;

  $query = new WP_Query([
    'post_type' => 'tour',
    'posts_per_page' => 5,
  ]);

  if ($query->have_posts() ) {
    while ($query->have_posts()) {
      $query->the_post();?>
  <div class="single-recent-blog-post">
    <div class="thumb">
      <?php if( has_post_thumbnail() ) {
          the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid'));
        } else {
          echo '<img src="'.get_template_directory_uri().'/images/img-default.png" alt="" class="img-fluid" />';
        }?>
      <ul class="thumb-info">
        <li>
          <a href="<?=get_author_posts_url(get_the_author_meta('ID'));?>">
            <i class="ti-user"></i><?php the_author();?>
          </a>
        </li>
        <li>
          <span>
            <i class="ti-notepad"></i><?php the_time('j F Y');?>
          </span>
        </li>
        <li>
          <a href="<?php comments_link();?>">
            <i class="ti-themify-favicon"></i>
            <?php plural_form(get_comments_number(), array('Комментарий', 'Комментария', 'Комментариев'));?>
          </a>
        </li>
      </ul>
    </div>
    <div class="details mt-20">
      <a href="<?=get_the_permalink();?>"><h3><?php the_title();?></h3></a>
      <p class="tag-list-inline"><?php the_tags( 'Теги: ', ', ') ?></p>
      <p class="mt-3"><?php the_excerpt();?></p>
      <a href="<?=get_the_permalink();?>" class="button">Читать статью <i class="ti-arrow-right"></i></a>
    </div>
  </div>
  <?php }
  } else { ?>
    <p>Записей нет.</p>
  <?php }
  wp_reset_postdata(); // Сбрасываем $post?>
  <div class="row">
    <div class="col-lg-12">
      <?php wp_pagenavi();
        /*the_posts_pagination(array(
          'prev_text' => '<li class="page-item page-link">
            <span aria-hidden="true">
              <i class="ti-angle-left"></i>
            </span>
        </li>',
      'next_text' => '<li class="page-item page-link">
          <span aria-hidden="true">
            <i class="ti-angle-right"></i>
          </span>
        </li>',
      'before_page_number' => '<li class="page-item page-link">',
      'after_page_number'  => '</li>'
      ));*/?>
    </div>
  </div>
</div>
