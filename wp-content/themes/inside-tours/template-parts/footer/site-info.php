<?php
/**
 * Displays footer site info
 *
 * @subpackage inside-tours
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info">
	<div class="container">
		<p><?php inside_tours_credit(); ?> <?php echo esc_html(get_theme_mod('inside_tours_footer_copy',__('By Luzuk','inside-tours'))); ?></p>
	</div>
</div>