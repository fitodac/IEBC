<?php
  $logo_secondary = carbon_get_theme_option('smpx_logo_secondary');
  $address = carbon_get_theme_option('smpx_address_section');
  $phones = carbon_get_theme_option('smpx_phone', 'complex');
  $emails = carbon_get_theme_option('smpx_email', 'complex');
  $copyright = carbon_get_theme_option('smpx_copy');
?>
<footer class="main-footer">
  <div class="container">
    <?php if( $logo_secondary ): ?>
      <span class="brand-alt">
        <img src="<?= $logo_secondary; ?>" alt="logo">
        <span class="sr-only"><?php bloginfo( 'name' ); ?></span>
      </span>
    <?php endif; ?>


    <address>
      <?php 
      if($address): 
        echo $address;
      endif;
      ?>
    </address>

    <div class="copy"><?= $copyright; ?></div>
  </div><!-- container end -->

</footer><!-- main-footer end -->


<?php wp_footer(); ?>
</body>
</html>
