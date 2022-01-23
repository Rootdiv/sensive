<?php get_header();?>
    <!--================Header Menu Area =================-->
    <main class="site-main">
      <!--================Hero Banner start =================-->
      <section class="mb-30px">
        <div class="container">
          <div class="hero-banner">
            <div class="hero-banner__content">
              <h3><?php the_field('title', $post->ID);?></h3>
              <h1><?php the_field('subtitle', $post->ID);?></h1>
              <h4></h4>
            </div>
          </div>
        </div>
      </section>
      <!--================Hero Banner end =================-->

      <!--================ Blog slider start =================-->
      <section>
        <div class="container">
          <div class="owl-carousel owl-theme blog-slider">
            <?php
            global $post;

            $query = new WP_Query([
              'posts_per_page' => 5,
              'post_type' => 'tour',
              'order' => 'ASC'
            ]);

            if ($query->have_posts()) {
              while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="card blog__slide text-center">
                  <div class="blog__slide__img">
                  <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img rounded-0']);?>
                  </div>
                  <div class="blog__slide__content">
                    <a href="<?=get_the_permalink();?>"><?php the_title();?></a>
                    <p><?=human_time_diff(get_the_time('U'), current_time('timestamp')) . ' назад'; ?></p>
                  </div>
                </div>
                <?php
              }
            } else {
              ?>
              <p>Записей пока нет</p>
              <?php
            }
            wp_reset_postdata(); // Сбрасываем $post
            ?>
          </div>
        </div>
      </section>
      <!--================ Blog slider end =================-->

      <!--================ Start Blog Post Area =================-->
      <section class="blog-post-area section-margin mt-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <?php global $post;

              $query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 4,
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
            </div>
            <!-- Start Blog Post Siddebar -->
            <?php get_sidebar()?>
            <!-- End Blog Post Siddebar -->
          </div>
        </div>
      </section>
      <!--================ End Blog Post Area =================-->
    </main>
<?php get_footer();?>
