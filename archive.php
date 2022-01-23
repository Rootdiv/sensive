<?php get_header();
$posts = '';
if (is_category()) {
  $posts = 'из категории ' . get_queried_object()->name;
}
if (is_tag()) {
  $posts = 'с тегом ' . get_queried_object()->name;
}
if (is_author()) {
  $posts = 'постов ' . get_the_author_meta('display_name');
}
if (is_date()) {
  $posts = 'по дате ' . get_the_date('j F Y');
}
?>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Страница записей <?=$posts;?></h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Страница записей <?=$posts;?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <?php $args = array_merge($wp_query->query, array('post_type' => array('post')));
              query_posts($args);
              if (have_posts()) { while (have_posts()) { the_post(); ?>
                <div class="col-md-6">
                  <div class="single-recent-blog-post card-view">
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
                          <a href="<?php comments_link();?>">
                            <i class="ti-themify-favicon"></i>
                            <?php plural_form(get_comments_number(), array('Комментарий', 'Комментария', 'Комментариев'));?>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="<?=get_the_permalink();?>">
                        <h3><?php the_title();?></h3>
                      </a>
                      <p><?php the_excerpt();?></p>
                      <a href="<?=get_the_permalink();?>" class="button">Читать статью <i class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
                <?php }
              } else { ?>
                <p>Записей нет.</p>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <?php the_posts_pagination(array(
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
                ));?>
              </div>
            </div>
          </div>
          <!-- Start Blog Post Siddebar -->
          <?php get_sidebar()?>
          <!-- End Blog Post Siddebar -->
        </div>
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
<?php get_footer();?>
