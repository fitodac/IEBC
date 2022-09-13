<?php
// Template Name: Donde Encontrarnos

$page = get_page_by_path('soy-nuevo/donde-encontrarnos');
include( locate_template('templates/top-child-pages.php') );


$map = carbon_get_theme_option( 'smpx_map' );
$map_zoom = carbon_get_theme_option( 'smpx_map_zoom' );
$marker = carbon_get_theme_option( 'smpx_map_marker' );
?>

<?php if($map): ?>
<section 
	class="section"
	id="section-map">
		<div 
		class="gmap" 
		data-address="<?= $map; ?>" 
		data-zoom="<?= $map_zoom; ?>" 
		<?php echo $marker ? 'data-marker="'.$marker.'"' : ''; ?> 
		data-top="transform: translateY(0px); opacity: 1;" 
		data--60p-top="transform: translateY(-150px); opacity: 0;"></div>
</section>
<?php endif; ?>
