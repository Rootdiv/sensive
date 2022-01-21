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
            <!-- <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="<?=get_template_directory_uri();?>/img/blog/blog-slider/blog-slide2.png" alt="" />
              </div>
              <div class="blog__slide__content">
                <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                <p>2 days ago</p>
              </div>
            </div>
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="<?=get_template_directory_uri();?>/img/blog/blog-slider/blog-slide3.png" alt="" />
              </div>
              <div class="blog__slide__content">
                <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                <p>2 days ago</p>
              </div>
            </div>
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="<?=get_template_directory_uri();?>/img/blog/blog-slider/blog-slide1.png" alt="" />
              </div>
              <div class="blog__slide__content">
                <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                <p>2 days ago</p>
              </div>
            </div>
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="<?=get_template_directory_uri();?>/img/blog/blog-slider/blog-slide2.png" alt="" />
              </div>
              <div class="blog__slide__content">
                <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                <p>2 days ago</p>
              </div>
            </div>
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="<?=get_template_directory_uri();?>/img/blog/blog-slider/blog-slide3.png" alt="" />
              </div>
              <div class="blog__slide__content">
                <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                <p>2 days ago</p>
              </div>
            </div> -->
          </div>
        </div>
      </section>
      <!--================ Blog slider end =================-->

      <!--================ Start Blog Post Area =================-->
      <section class="blog-post-area section-margin mt-4">
        <div class="container">
          <div class="row">
            <?php get_template_part('template-parts/content', 'blog');?>
            <!-- Start Blog Post Siddebar -->
            <?php get_sidebar()?>
            <!-- End Blog Post Siddebar -->
          </div>
        </div>
      </section>
      <!--================ End Blog Post Area =================-->
    </main>
<?php get_footer();?>
