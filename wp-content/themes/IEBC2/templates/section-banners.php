<section id="section-banners" class="section">
  <div class="container">
    <div class="h4">Estamos para ayudarte</div>

    <div class="row">
      <?php if( is_active_sidebar('2-columns-banners') ) : 
        dynamic_sidebar('2-columns-banners');
      endif; ?>
    </div><!-- row end -->

  </div><!-- container end -->
</section><!-- section end -->