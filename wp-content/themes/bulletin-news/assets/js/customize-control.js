/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function( $, api ) {
    wp.customize.bind('ready', function() {
    	// Show message on change.
        var bulletin_news_settings = ['bulletin_news_slider_num', 'bulletin_news_latest_num', 'bulletin_news_services_num', 'bulletin_newsjects_num', 'bulletin_news_testimonial_num', 'bulletin_news_blog_section_num', 'bulletin_news_reset_settings', 'bulletin_news_testimonial_num', 'bulletin_news_partner_num'];
        _.each( bulletin_news_settings, function( bulletin_news_setting ) {
            wp.customize( bulletin_news_setting, function( setting ) {
                var blogRiderNotice = function( value ) {
                    var name = 'needs_refresh';
                    if ( value && bulletin_news_setting == 'bulletin_news_reset_settings' ) {
                        setting.notifications.add( 'needs_refresh', new wp.customize.Notification(
                            name,
                            {
                                type: 'warning',
                                message: bulletin_news_localized_data.reset_msg,
                            }
                        ) );
                    } else if( value ){
                        setting.notifications.add( 'reset_name', new wp.customize.Notification(
                            name,
                            {
                                type: 'info',
                                message: bulletin_news_localized_data.refresh_msg,
                            }
                        ) );
                    } else {
                        setting.notifications.remove( name );
                    }
                };

                setting.bind( blogRiderNotice );
            });
        });

        /* === Radio Image Control === */
        api.controlConstructor['bulletin-news-radio-color'] = api.Control.extend( {
            ready: function() {
                var control = this;

                $( 'input:radio', control.container ).change(
                    function() {
                        control.setting.set( $( this ).val() );
                    }
                );
            }
        } );

        

        // Sortable sections
        jQuery( "body" ).on( 'hover', '.bulletin-news-drag-handle', function() {
            jQuery( 'ul.bulletin-news-sortable-list' ).sortable({
                handle: '.bulletin-news-drag-handle',
                axis: 'y',
                update: function( e, ui ){
                    jQuery('input.bulletin-news-sortable-input').trigger( 'change' );
                }
            });
        });

        /* On changing the value. */
        jQuery( "body" ).on( 'change', 'input.bulletin-news-sortable-input', function() {
            /* Get the value, and convert to string. */
            this_checkboxes_values = jQuery( this ).parents( 'ul.bulletin-news-sortable-list' ).find( 'input.bulletin-news-sortable-input' ).map( function() {
                return this.value;
            }).get().join( ',' );

            /* Add the value to hidden input. */
            jQuery( this ).parents( 'ul.bulletin-news-sortable-list' ).find( 'input.bulletin-news-sortable-value' ).val( this_checkboxes_values ).trigger( 'change' );

        });

        // Deep linking for counter section to about section.
        jQuery('.bulletin-news-edit').click(function(e) {
            e.preventDefault();
            var jump_to = jQuery(this).attr( 'data-jump' );
            wp.customize.section( jump_to ).focus()
        });

        wp.customize.bind('ready', function() {
            jQuery('a[data-open="bulletin-news-recent-posts"]').click(function(e) {
                e.preventDefault();
                wp.customize.section( 'sidebar-widgets-homepage-sidebar' ).focus()
            });
        });
        
    });
})( jQuery, wp.customize );
