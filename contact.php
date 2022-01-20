<?php
/*
Template Name: Страница контактов
Template Post Type: page
*/
get_header();?>
    <!--================ Hero sm banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Связаться с нами</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=get_home_url();?>">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Связаться с нами</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm banner end =================-->

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
      <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
          <?php the_content();?>
        </div>

        <div class="row">
          <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-home"></i></span>
              <div class="media-body">
                <h3><?php the_field('address_city');?></h3>
                <p><?php the_field('address');?></p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-headphone"></i></span>
              <div class="media-body">
                <h3><a href="tel:<?php the_field('phone');?>"><?php the_field('phone');?></a></h3>
                <p><?php the_field('time_works');?></p>
              </div>
            </div>
            <div class="media contact-info">
              <span class="contact-info__icon"><i class="ti-email"></i></span>
              <div class="media-body">
                <h3><a href="mailto:<?php the_field('email');?>"><?php the_field('email');?></a></h3>
                <p><?php the_field('email_text');?></p>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-lg-9 form-contact contact_form">
            <?=do_shortcode('[contact-form-7 id="110" title="Контактная форма"]');?>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ contact section end ================= -->
<?php get_footer();?>
