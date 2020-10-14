<?php
/**
 * Popular News.
 *
 * @package bulletin_news
 */

function bulletin_news_popular_news() {
	register_widget( 'Bulletin_News_Popular_News' );
}
add_action( 'widgets_init', 'bulletin_news_popular_news' );

class Bulletin_News_Popular_News extends WP_Widget{ 

	function __construct() {
		global $control_ops;
		$widget_popular = array(
		  'classname'   => 'popular-news',
		  'description' => esc_html__( 'Add Widget to Display Popular News.', 'bulletin-news' )
		);
		parent::__construct( 'Bulletin_News_Popular_News',esc_html__( 'BN: Popular News', 'bulletin-news' ), $widget_popular, $control_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, 
			array( 
			  'section_title'			=> esc_html__( 'Popular News', 'bulletin-news' ),		
			  'section_category'       	=> '', 
			  'no_of_posts'          => 5, 
			  'show_category'	=> true,	
			) 
		);
		$Section_title     			= isset( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : esc_html__( 'Popular News', 'bulletin-news' );
		$section_category 			= isset( $instance['section_category'] ) ? absint( $instance['section_category'] ) : 0;
		$no_of_posts    			= isset( $instance['no_of_posts'] ) ? absint( $instance['no_of_posts'] ) : 5;   
		$show_category 		= isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : true; 
	?>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'section_title' )); ?>"><?php echo esc_html__( 'Widget Title:', 'bulletin-news' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'section_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'section_title' )); ?>" type="text" value="<?php echo esc_attr($Section_title); ?>" />
		</p>	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'section_category' ) ); ?>">
				<?php esc_html_e( 'Choose One Category:', 'bulletin-news' ); ?>			
			</label>

			<?php
				wp_dropdown_categories(array(
					'show_option_none' => '',
					'class' 		  => 'widefat',
					'show_option_all'  => esc_html__('Latest News','bulletin-news'),
					'name'             => esc_attr($this->get_field_name( 'section_category' )),
					'selected'         => absint( $section_category ),          
				) );
			?>
		</p>

	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'no_of_posts' )); ?>">
	    		<?php echo esc_html__( 'Choose Number of Posts (Maximum: 5)', 'bulletin-news' );?>    		
	    	</label>

	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'no_of_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'no_of_posts' )); ?>" type="number" step="1" min="1" max="5" value="<?php echo esc_attr($no_of_posts); ?>"  />
	    </p>	
  
    <?php
    }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['section_title'] 				= sanitize_text_field( $new_instance['section_title'] );
		$instance['section_category'] 			= absint( $new_instance['section_category'] );		
		$instance['no_of_posts'] 			= absint( $new_instance['no_of_posts']);
		$instance['show_category'] 		= (bool) $new_instance['show_category'];  	   
		return $instance;
	}

    function widget( $args, $instance ) {

    	extract( $args ); 
		$Section_title     			= isset( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : esc_html__( 'Popular News', 'bulletin-news' );
    	$Section_title 				= apply_filters( 'widget_title', $Section_title, $instance, $this->id_base );
    	
        $section_category  			= isset( $instance[ 'section_category' ] ) ? $instance[ 'section_category' ] : 0;
        $no_of_posts 			= ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 5; 
        $show_category		= isset( $instance['show_category'] ) ? $instance['show_category'] : true;
        echo $before_widget;
        ?>   		    
	        
        <?php $popular_news_args = array(
            'posts_per_page' => absint( $no_of_posts ),
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in' => get_option( 'sticky_posts' ),      
        );

        if ( absint( $section_category ) > 0 ) {
          $popular_news_args['cat'] = absint( $section_category );
        }

        $the_loop = new WP_Query( $popular_news_args ); 
    	if ( $the_loop -> have_posts() ) : 
        $i = 1;
        $count = count( ( array ) $the_loop ); ?> 
        	<div class="shadow-popular-news">
				<?php if ( !empty( $Section_title ) ): ?>
		                <?php echo $args['before_title'] . esc_html($Section_title) . $args['after_title']; ?>
			        <?php endif; ?>	 

	                <div class="section-content clear">
	                    <?php 
	                        while ( $the_loop -> have_posts() ) : $the_loop -> the_post(); 
	                            if ( in_array( $i, array( 1, 2 ) ) ) : ?>
	                                <div class="popular-post-wrapper">
	                            <?php endif; ?>
	                                <article class="hentry <?php echo ( 1 == $i ) ? 'full-width' : 'half-width'; ?>">
	                                    <div class="post-wrapper">
	                                        <?php if ( has_post_thumbnail() ) : ?>
	                                            <div class="featured-image">
	                                                <a href="<?php the_permalink(); ?>">
	                                                    <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	                                                </a>
	                                            </div><!-- .recent-image -->
	                                        <?php endif; ?>

	                                        <div class="shadow-entry-container">
	                                            <div class="shadow-entry-meta"> 
		                                            <?php bulletin_news_cats(); ?>
		                                        </div>
	                                            <header class="shadow-entry-header">
	                                                <h2 class="shadow-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                            </header>
	                                            <div class="shadow-entry-meta">   
	                                            	<?php bulletin_news_posted_on();
	                                            	bulletin_news_post_author(); ?>
		                                        </div><!-- .entry-meta -->

	                                            <?php if ( 1 == $i ) : ?>
	                                                <div class="shadow-entry-content">
	                                                    <?php the_excerpt(); ?>
	                                                </div><!-- .entry-content -->
	                                            <?php endif; ?>
	                                        </div><!-- .entry-container -->
	                                    </div><!-- .post-wrapper -->
	                                </article>
	                            <?php if ( 1 == $i || $i == $count ) : ?>
	                                </div><!-- .popular-post-wrapper -->
	                            <?php endif; 
	                        $i++; endwhile; 
	                     ?>
	                </div><!-- .section-content -->  
	            </div> 
            <?php endif;
            wp_reset_postdata(); ?>	 
           </div>       		    
        <?php echo $after_widget;
    } 
}