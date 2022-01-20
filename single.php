<?php get_header(); ?>
  <!--================ Hero sm Banner start =================-->
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1><?php the_title();?></h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Главная</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php the_title();?></li>
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
          <div class="main_blog_details">
            <?php if( has_post_thumbnail() ) {
              the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid'));
            } else {
              echo '<img src="'.get_template_directory_uri().'/images/img-default.png" alt="" class="img-fluid" />';
            }?>
            <a href="<?=get_the_permalink();?>"><h4><?php the_title();?></h4></a>
            <div class="user_details">
              <div class="float-left">
                <?php the_tags('', ' ') ?>
              </div>
              <div class="float-right mt-sm-0 mt-3">
                <div class="media">
                  <div class="media-body">
                    <h5><?php the_author();?></h5>
                    <p><?php the_time('j M Y H:i');?>m</p>
                  </div>
                  <div class="d-flex">
                    <?=get_avatar($comment, 42);?>
                  </div>
                </div>
              </div>
            </div>
            <?php the_content();?>
            <blockquote class="blockquote">
              <?php the_excerpt();?>
            </blockquote>
              <div class="news_d_footer flex-column flex-sm-row">
                <span class="mr-2"><i class="ti-themify-favicon"></i></span>
                <?php plural_form(get_comments_number(), array('Комментарий', 'Комментария', 'Комментариев'));?>
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-dribbble"></i></a>
                  <a href="#"><i class="fab fa-behance"></i></a>
                </div>
              </div>
            </div>
            <?php
            while (have_posts()):
              the_post();
              if (comments_open() || get_comments_number()):
                comments_template();
              endif;
            endwhile;?>
          </div>
          <!-- Start Blog Post Siddebar -->
          <?php get_sidebar()?>
          <!-- End Blog Post Siddebar -->
        </div>
      </div>
    </div>
  </section>
  <!--================ End Blog Post Area =================-->
<?php get_footer();?>
