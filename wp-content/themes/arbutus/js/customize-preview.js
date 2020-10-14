/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Footer copyright name.
	wp.customize( 'copy_name', function( value ) {
		value.bind( function( to ) {
			$( '#footer-copy-name' ).text( to );
		} );
	} );

	// Footer credits.
	wp.customize( 'powered_by_wp', function( value ) {
		value.bind( function( to ) {
			$( '.wordpress-credit' ).toggle( to );
		} );
	} );
	wp.customize( 'theme_meta', function( value ) {
		value.bind( function( to ) {
			$( '.theme-credit' ).toggle( to );
		} );
	} );

	wp.customize( 'color_hue', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#arbutus-colors' ),
			    color = style.data( 'color_hue' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color + ', ' ).join( to + ', ' ); // css.replaceAll, only do unitless numbers.
			style.html( css )
			     .data( 'color_hue', to );
		} );
	} );

} )( jQuery );
