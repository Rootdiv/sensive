<?php get_header();?>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1><?php
              printf('Поиск: %s', get_search_query());
            ?></h1>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
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
<?php get_footer();?>
