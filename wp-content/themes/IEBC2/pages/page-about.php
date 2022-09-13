<?php
get_header();
// Template Name: Sobre Nosotros

$supertitle = carbon_get_the_post_meta('smpx_page_supertitle');
$title = carbon_get_the_post_meta('smpx_page_title');
$subtitle = carbon_get_the_post_meta('smpx_page_subtitle');
$mision = carbon_get_the_post_meta('smpx_mision');
$vision = carbon_get_the_post_meta('smpx_vision');
?>

<section 
  class="section" 
  id="section-<?= $post->post_name; ?>" 
  style="background-image:url('<?php echo the_post_thumbnail_url(); ?>');">
  <div class="container">
    <div class="h2 p-b"><?= $title ? $title : get_the_title(); ?></div>

    <div class="row">
      <div class="col-sm-6">
        <h3>Misión</h3>
        <?= $mision; ?>
      </div><!-- col end -->

      <div class="col-sm-6">
        <h3>Visión</h3>
        <?= $vision; ?>
      </div><!-- col end -->
    </div><!-- row end -->

  </div><!-- container end -->
</section>


<?php
get_template_part( 'pages/page', 'believe' );
get_template_part( 'pages/page', 'history' );

get_footer();




