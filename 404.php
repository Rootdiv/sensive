<?php get_header();?>
    <!--================ Hero sm banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>404 <?php _e('Page not found', 'sensive');?></h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">404 <?php _e('Page not found', 'sensive');?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm banner end =================-->
<?php get_footer();?>
