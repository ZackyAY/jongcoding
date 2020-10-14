<?php
//about theme info
add_action( 'admin_menu', 'inside_tours_gettingstarted' );
function inside_tours_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'inside-tours'), esc_html__('About Theme', 'inside-tours'), 'edit_theme_options', 'inside_tours_guide', 'inside_tours_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function inside_tours_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'inside_tours_admin_theme_style');

//guidline for about theme
function inside_tours_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'inside-tours' );

?>

<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to Inside Tours WordPress Theme', 'inside-tours' ); ?> <span>Version: <?php echo esc_html($theme['Version']);?></span></h3>
		</div>
		<div class="started">
			<hr>
			<div class="free-doc">
				<div class="lz-4">
					<h4><?php esc_html_e( 'Start Customizing', 'inside-tours' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Go to', 'inside-tours' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'inside-tours' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'inside-tours' ); ?></span>
					</ul>
				</div>
				<div class="lz-4">
					<h4><?php esc_html_e( 'Support', 'inside-tours' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Send your query to our', 'inside-tours' ); ?> <a href="<?php echo esc_url( INISIDE_TOURS_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support', 'inside-tours' ); ?></a></span>
					</ul>
				</div>
			</div>
			<p><?php esc_html_e( 'Inside tours is one of the most accepted travel WordPress themes of premium level with global acceptance because of the prime features associated with it and some of these are multipurpose nature, elegance, sophistication, retina ready, translation ready, personalization options, CTA, clean code, SEO friendly, faster page load time etc and all these features make it a perfect fit for the travel agency website or for a blog related to the travel and journey. Inside tours theme is highly applicable for the travellers as well as tour operators or for the tourist agencies and the travel diaries. It is also good for the travel magazines as well as the travel guides or consultancy related to the travel and tourism. It is a widely accepted WordPress theme of the premium order related to the travel agencies as well as the tour planners and has some ground breaking features like the clean code, customization options and besides this, it is mobile friendly making it a fine choice for the hotels as well as airline line agencies also. It is good for anyone who wants to start a business related to the travel and tourism. Inside Tours theme is also good for adventure sports.', 'inside-tours')?></p>
			<hr>			
			<div class="col-left-inner">
				<h3><?php esc_html_e( 'Get started with Free Inside Tours Theme', 'inside-tours' ); ?></h3>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/customizer-image.png" alt="" />
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'inside-tours'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<a href="<?php echo esc_url( INISIDE_TOURS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'inside-tours'); ?></a>
			<a href="<?php echo esc_url( INISIDE_TOURS_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'inside-tours'); ?></a>
			<a href="<?php echo esc_url( INISIDE_TOURS_PRO_DOCS ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'inside-tours'); ?></a>
			<hr class="secondhr">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/inside-tours.jpg" alt="" />
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'inside-tours'); ?></h3>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon01.png" alt="" />
			<h4><?php esc_html_e( 'Banner Slider', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon02.png" alt="" />
			<h4><?php esc_html_e( 'Theme Options', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon03.png" alt="" />
			<h4><?php esc_html_e( 'Custom Innerpage Banner', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon04.png" alt="" />
			<h4><?php esc_html_e( 'Custom Colors and Images', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon05.png" alt="" />
			<h4><?php esc_html_e( 'Fully Responsive', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon06.png" alt="" />
			<h4><?php esc_html_e( 'Hide/Show Sections', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon07.png" alt="" />
			<h4><?php esc_html_e( 'Woocommerce Support', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon08.png" alt="" />
			<h4><?php esc_html_e( 'Limit to display number of Posts', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon09.png" alt="" />
			<h4><?php esc_html_e( 'Multiple Page Templates', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon10.png" alt="" />
			<h4><?php esc_html_e( 'Custom Read More link', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon11.png" alt="" />
			<h4><?php esc_html_e( 'Code written with WordPress standard', 'inside-tours'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon12.png" alt="" />
			<h4><?php esc_html_e( '100% Multi language', 'inside-tours'); ?></h4>
		</div>
	</div>
</div>
<?php } ?>