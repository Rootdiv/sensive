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
                <span class="mr-2"><i class="ti-themify-favicon"></i></span>06 Comments
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-dribbble"></i></a>
                  <a href="#"><i class="fab fa-behance"></i></a>
                </div>
              </div>
            </div>
            <div class="comments-area">
              <h4>05 Comments</h4>
              <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                      <div class="user justify-content-between d-flex">
                          <div class="thumb">
                              <img src="img/blog/c1.jpg" alt="">
                          </div>
                          <div class="desc">
                              <h5><a href="#">Emilly Blunt</a></h5>
                              <p class="date">December 4, 2017 at 3:12 pm </p>
                              <p class="comment">
                                  Never say goodbye till the end comes!
                              </p>
                          </div>
                      </div>
                      <div class="reply-btn">
                              <a href="" class="btn-reply text-uppercase">reply</a>
                      </div>
                  </div>
              </div>
              <div class="comment-list left-padding">
                  <div class="single-comment justify-content-between d-flex">
                      <div class="user justify-content-between d-flex">
                          <div class="thumb">
                              <img src="img/blog/c2.jpg" alt="">
                          </div>
                          <div class="desc">
                              <h5><a href="#">Elsie Cunningham</a></h5>
                              <p class="date">December 4, 2017 at 3:12 pm </p>
                              <p class="comment">
                                  Never say goodbye till the end comes!
                              </p>
                          </div>
                      </div>
                      <div class="reply-btn">
                              <a href="" class="btn-reply text-uppercase">reply</a>
                      </div>
                  </div>
              </div>
              <div class="comment-list left-padding">
                  <div class="single-comment justify-content-between d-flex">
                      <div class="user justify-content-between d-flex">
                          <div class="thumb">
                              <img src="img/blog/c3.jpg" alt="">
                          </div>
                          <div class="desc">
                              <h5><a href="#">Annie Stephens</a></h5>
                              <p class="date">December 4, 2017 at 3:12 pm </p>
                              <p class="comment">
                                  Never say goodbye till the end comes!
                              </p>
                          </div>
                      </div>
                      <div class="reply-btn">
                              <a href="" class="btn-reply text-uppercase">reply</a>
                      </div>
                  </div>
              </div>
              <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                      <div class="user justify-content-between d-flex">
                          <div class="thumb">
                              <img src="img/blog/c4.jpg" alt="">
                          </div>
                          <div class="desc">
                              <h5><a href="#">Maria Luna</a></h5>
                              <p class="date">December 4, 2017 at 3:12 pm </p>
                              <p class="comment">
                                  Never say goodbye till the end comes!
                              </p>
                          </div>
                      </div>
                      <div class="reply-btn">
                              <a href="" class="btn-reply text-uppercase">reply</a>
                      </div>
                  </div>
              </div>
              <div class="comment-list">
                  <div class="single-comment justify-content-between d-flex">
                      <div class="user justify-content-between d-flex">
                          <div class="thumb">
                              <img src="img/blog/c5.jpg" alt="">
                          </div>
                          <div class="desc">
                              <h5><a href="#">Ina Hayes</a></h5>
                              <p class="date">December 4, 2017 at 3:12 pm </p>
                              <p class="comment">
                                  Never say goodbye till the end comes!
                              </p>
                          </div>
                      </div>
                      <div class="reply-btn">
                              <a href="" class="btn-reply text-uppercase">reply</a>
                      </div>
                  </div>
              </div>
            </div>
            <div class="comment-form">
                <h4>Leave a Reply</h4>
                <form>
                    <div class="form-group form-inline">
                      <div class="form-group col-lg-6 col-md-6 name">
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 email">
                        <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                      </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                    </div>
                    <a href="#" class="button submit_btn">Post Comment</a>
                </form>
            </div>
        </div>
        <!-- Start Blog Post Siddebar -->
        <?php get_sidebar()?>
        <!-- End Blog Post Siddebar -->
      </div>
  </section>
  <!--================ End Blog Post Area =================-->
<?php get_footer();?>
