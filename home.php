<?php get_header();?>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Страница блога</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Страница блога</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <?php get_template_part('template-parts/content', 'blog');?>
          <!-- Start Blog Post Siddebar -->
          <?php get_sidebar()?>
        </div>
        <!-- End Blog Post Siddebar -->
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
<?php get_footer();?>
