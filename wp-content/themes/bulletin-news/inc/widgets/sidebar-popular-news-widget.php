<?php
/**
 * Popular News.
 *
 * @package bulletin_news
 */

function bulletin_news_sidebar_popular_news() {
	register_widget( 'Bulletin_News_Sidebar_Popular_News' );
}
add_action( 'widgets_init', 'bulletin_news_sidebar_popular_news' );

class Bulletin_News_Sidebar_Popular_News extends WP_Widget{ 

	function __construct() {
		global $control_ops;
		$widget_sidebar_popular = array(
		  'classname'   => 'sidebar-popular-news',
		  'description' => esc_html__( 'Add Widget to Display Popular News.', 'bulletin-news' )
		);
		parent::__construct( 'Bulletin_News_Sidebar_Popular_News',esc_html__( 'BN: Sidebar Popular News', 'bulletin-news' ), $widget_sidebar_popular, $control_ops );
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
		$section_title     			= isset( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : esc_html__( 'Popular News', 'bulletin-news' );
		$section_category 			= isset( $instance['section_category'] ) ? absint( $instance['section_category'] ) : 0;
		$no_of_posts    			= isset( $instance['no_of_posts'] ) ? absint( $instance['no_of_posts'] ) : 5;   
		$show_category 		= isset( $instance['show_category'] ) ? (bool) $instance['show_category'] : true; 
	?>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id( 'section_title' )); ?>"><?php echo esc_html__( 'Widget Title:', 'bulletin-news' ); ?></label>
	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'section_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'section_title' )); ?>" type="text" value="<?php echo esc_attr($section_title); ?>" />
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

	    	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'no_of_posts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'no_of_posts' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($no_of_posts); ?>" max="5" />
	    </p>	
  
    <?php
    }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['section_title'] 				= sanitize_text_field( $new_instance['section_title'] );
		$instance['section_category'] 			= absint( $new_instance['section_category'] );		
		$instance['no_of_posts'] 			= absint( $new_instance['no_of_posts'] );
		$instance['show_category'] 		= (bool) $new_instance['show_category'];  	   
		return $instance;
	}

    function widget( $args, $instance ) {

    	extract( $args ); 
		$section_title     			= isset( $instance['section_title'] ) ? esc_html( $instance['section_title'] ) : esc_html__( 'Popular News', 'bulletin-news' );
    	$section_title 				= apply_filters( 'widget_title', $section_title, $instance, $this->id_base );
    	
        $section_category  			= isset( $instance[ 'section_category' ] ) ? $instance[ 'section_category' ] : 0;
        $no_of_posts 			= ( ! empty( $instance['no_of_posts'] ) ) ? absint( $instance['no_of_posts'] ) : 5; 
        $show_category		= isset( $instance['show_category'] ) ? $instance['show_category'] : true;
        echo $before_widget;
        ?>   		    
	        
        <?php $recent_args = array(
            'posts_per_page' => absint( $no_of_posts ),
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in' => get_option( 'sticky_posts' ),      
        );

        if ( absint( $section_category ) > 0 ) {
          $recent_args['cat'] = absint( $section_category );
        }

        $recent_loop = new WP_Query( $recent_args ); 
         ?>		            
            	<?php if ( !empty( $section_title ) ): ?>
		           <?php echo $args['before_title'] . esc_html($section_title) . $args['after_title']; ?>
		        <?php endif; ?>    
 			<ul>
    			<?php if ($recent_loop->have_posts()) : 
        		 while ( $recent_loop->have_posts() ) : $recent_loop->the_post(); 
        		 	if( has_post_thumbnail() ){
					        $image_class = 'has-post-thumbnail'; 
					    } else {
					        $image_class = 'no-post-thumbnail'; 
					    }
					    ?>
                    <li class="<?php echo esc_attr( $image_class ); ?>">
				        <?php if( has_post_thumbnail() ) : ?> 
				             <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail') ?></a>
				        <?php endif; ?>
				        
				        <div class="shadow-entry-meta">   
                        	<?php bulletin_news_posted_on();
                        	bulletin_news_post_author(); ?>
                        </div><!-- .entry-meta -->

				        <header class="shadow-entry-header">
                            <h3 class="shadow-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </header>
				    </li>
        		<?php endwhile;  endif;
        		wp_reset_postdata();?>
        		</ul>	    
        <?php echo $after_widget;

    } 

}