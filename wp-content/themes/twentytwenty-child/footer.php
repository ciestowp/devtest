<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
		<div class="custome_footer">
			<?php echo do_shortcode('[elementor-template id="541"]'); ?>			
		</div>
		<?php wp_footer(); ?>
	</body>
</html>

<script>
	jQuery(window).scroll(function($) { 
		if (jQuery(document).scrollTop() > 50) {
			jQuery('.main_header').addClass('stickey');
		}else{
			jQuery('.main_header').removeClass('stickey');			
		}
	});
</script>