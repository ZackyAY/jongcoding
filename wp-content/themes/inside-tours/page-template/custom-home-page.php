<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'inside_tours_above_slider' ); ?>

<?php if( get_theme_mod('inside_tours_slider_hide_show') != ''){ ?>
	<section id="slider">
	  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
		    <?php $inside_tours_slider_pages = array();
		      	for ( $count = 1; $count <= 4; $count++ ) {
			        $mod = intval( get_theme_mod( 'inside_tours_slider' . $count ));
			        if ( 'page-none-selected' != $mod ) {
			          	$inside_tours_slider_pages[] = $mod;
			        }
		      	}
		      	if( !empty($inside_tours_slider_pages) ) :
			        $args = array(
			          	'post_type' => 'page',
			          	'post__in' => $inside_tours_slider_pages,
			          	'orderby' => 'post__in'
			        );
		        $query = new WP_Query( $args );
		        if ( $query->have_posts() ) :
		          $i = 1;
		    ?>     
		    <div class="carousel-inner" role="listbox">
		      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
		        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
		          	<a href="<?php echo esc_url( get_permalink() );?>"><?php the_post_thumbnail(); ?></a>
		          	<div class="carousel-caption">
			            <div class="inner_carousel">
			              	<h1><?php the_title();?></h1>
			              	<p><?php $excerpt = get_the_excerpt(); echo esc_html( inside_tours_string_limit_words( $excerpt,20 ) ); ?></p>
			            </div>
			            <div class="read-btn">
			              <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','inside-tours'); ?><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','inside-tours' );?></span>
			              </a>
				       	</div>
		          	</div>
		        </div>
		      	<?php $i++; endwhile; 
		      	wp_reset_postdata();?>
		    </div>
		    <?php else : ?>
		    	<div class="no-postfound"></div>
		    <?php endif;
		    endif;?>
		    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
		      <span class="screen-reader-text"><?php esc_html_e( 'Prev','inside-tours' );?></span>
		    </a>
		    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
		      <span class="screen-reader-text"><?php esc_html_e( 'Next','inside-tours' );?></span>
		    </a>
	  	</div>  
	  	<div class="clearfix"></div>
	</section>
<?php }?>

<?php do_action('inside_tours_below_slider'); ?>

<?php /*--Destination Section --*/?>

<section id="our_service">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<?php $inside_tours_postData =  get_theme_mod('inside_tours_post');
		        if($inside_tours_postData){
          			$args = array( 'name' => esc_html($inside_tours_postData ,'inside-tours'));
		          	$query = new WP_Query( $args );
		          	if ( $query->have_posts() ) :
		            	while ( $query->have_posts() ) : $query->the_post(); ?>
			                <div class="text-chooseus">
			                    <h2><?php the_title(); ?></h2>
			                    <hr>
			                    <p><?php the_excerpt(); ?></p>
			                    <div class="more-btn">
			                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('About Us','inside-tours'); ?><span class="screen-reader-text"><?php esc_html_e( 'About Us','inside-tours' );?></span></a>
			                    </div>
		            		</div>
		            	<?php endwhile; 
			            wp_reset_postdata();?>
			            <?php else : ?>
			            <div class="no-postfound"></div>
			            <?php
			        endif;
			    } ?> 
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="service-box">
		            <div class="row">
			      		<?php $inside_tours_catData1=  get_theme_mod('inside_tours_destination_cat'); 
			      		if($inside_tours_catData1){ 
			      			$page_query = new WP_Query(array( 'category_name' => esc_html($inside_tours_catData1 ,'inside-tours')));?>
			        		<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>	
			          			<div class="col-lg-6 col-md-6">
			          				<div class="content-topic">
								      	<?php the_post_thumbnail(); ?>
								      	<div class="content_inner">
								      		<h3><a href='<?php the_permalink(); ?>'><?php the_title();?><span class="screen-reader-text"><?php the_title();?></span></a></h3>
								    	</div>
								    </div>  
								</div>	
			          		<?php endwhile; 
			          	wp_reset_postdata();
			          	}?>
		      		</div>
				</div>
			</div>
		</div>			
		<div class="clearfix"></div>
	</div>
</section>

<?php do_action('inside_tours_below_destination_section'); ?>

<div class="container">
  	<?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>