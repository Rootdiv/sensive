    <!--================ Start Footer Area =================-->
    <footer class="footer-area section-padding">
      <div class="container">
        <div class="row">
          <?php if (!dynamic_sidebar('footer')) : dynamic_sidebar('footer'); endif; ?>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
          <p class="footer-text m-0">
            Копирайт &copy;<?php echo date('Y '); the_field('footer_text');?>
          </p>
        </div>
      </div>
    </footer>
    <!--================ End Footer Area =================-->
    <?php wp_footer();?>
  </body>
</html>
