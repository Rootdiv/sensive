<?php get_header();?>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Страница туров</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Страница туров</li>
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
          <?php get_template_part('template-parts/content', 'tours');?>
          <!-- Start Blog Post Siddebar -->
          <?php get_sidebar('tours')?>
          <!-- End Blog Post Siddebar -->
        </div>
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
<?php get_footer();?>
