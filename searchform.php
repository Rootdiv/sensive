<div class="single-sidebar-widget newsletter-widget">
  <div class="d-flex flex-row">
    <form role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>" class="search-form form-group">
      <input class="form-control" name="q" placeholder="Search" required="" type="text" value="">
      <input type="text" placeholder="Поиск" value="<?php echo get_search_query() ?>" required
        name="s" id="s" class="form-control" />
      <button class="click-btn btn btn-default bbtns"><i class="ti-search"></i></button>
    </form>
  </div>
</div>
