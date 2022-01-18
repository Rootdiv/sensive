<?php get_header();?>
    <!--================ Hero sm Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner hero-banner--sm">
          <div class="hero-banner__content">
            <h1>Blog Page</h1>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Page</li>
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
          <div class="col-lg-8">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
            <div class="single-recent-blog-post">
              <div class="thumb">
                <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid'));?>
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
                  <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                </ul>
              </div>
              <div class="details mt-20">
                <a href="<?=get_the_permalink();?>"><h3><?php the_title();?></h3></a>
                <p class="tag-list-inline">Tag: <a href="#">travel</a>, <a href="#">life style</a>, <a
                    href="#">technology</a>, <a href="#">fashion</a>
                </p>
                <p class="mt-3"><?php the_excerpt();?></p>
                <a href="<?=get_the_permalink();?>" class="button">Читать статью <i class="ti-arrow-right"></i></a>
              </div>
            </div>
            <?php endwhile; else : ?>
              <p>Записей нет.</p>
            <?php endif; ?>
            <div class="row">
              <div class="col-lg-12">
                <?php the_posts_pagination(array(
                    'prev_text' => '<li class="page-item page-link">
                      <span aria-hidden="true">
                        <i class="ti-angle-left"></i>
                    </a>
                  </li>',
                'next_text' => '<li class="page-item page-link">
                    <span aria-hidden="true">
                      <i class="ti-angle-right"></i>
                    </span>
                  </li>',
                'before_page_number' => '<li class="page-item page-link">',
                'after_page_number'  => '</li>'
                ));?></ul>
              </div>
            </div>
          </div>
          <!-- Start Blog Post Siddebar -->
          <div class="col-lg-4 sidebar-widgets">
            <div class="widget-wrap">
              <?php if (!dynamic_sidebar('sidebar-blog')) : dynamic_sidebar('sidebar-blog'); endif; ?>
              <div class="single-sidebar-widget popular-post-widget">
                <h4 class="single-sidebar-widget__title">Popular Post</h4>
                <div class="popular-post-list">
                  <div class="single-post-list">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="img/blog/thumb/thumb1.png" alt="" />
                      <ul class="thumb-info">
                        <li><a href="#">Adam Colinge</a></li>
                        <li><a href="#">Dec 15</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h6>Accused of assaulting flight attendant miktake alaways</h6>
                      </a>
                    </div>
                  </div>
                  <div class="single-post-list">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="img/blog/thumb/thumb2.png" alt="" />
                      <ul class="thumb-info">
                        <li><a href="#">Adam Colinge</a></li>
                        <li><a href="#">Dec 15</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h6>Tennessee outback steakhouse the worker diagnosed</h6>
                      </a>
                    </div>
                  </div>
                  <div class="single-post-list">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="img/blog/thumb/thumb3.png" alt="" />
                      <ul class="thumb-info">
                        <li><a href="#">Adam Colinge</a></li>
                        <li><a href="#">Dec 15</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h6>Tennessee outback steakhouse the worker diagnosed</h6>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="single-sidebar-widget tag_cloud_widget">
                <h4 class="single-sidebar-widget__title">Tags</h4>
                <ul class="list">
                  <li>
                    <a href="#">project</a>
                  </li>
                  <li>
                    <a href="#">love</a>
                  </li>
                  <li>
                    <a href="#">technology</a>
                  </li>
                  <li>
                    <a href="#">travel</a>
                  </li>
                  <li>
                    <a href="#">software</a>
                  </li>
                  <li>
                    <a href="#">life style</a>
                  </li>
                  <li>
                    <a href="#">design</a>
                  </li>
                  <li>
                    <a href="#">illustration</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- End Blog Post Siddebar -->
      </div>
    </section>
    <!--================ End Blog Post Area =================-->
<?php get_footer();?>
