/**
 * Functionality specific to Arbutus.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.arbutus', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets to fit the available space.
	 */
+	$( function() {
		if ( ! $.isFunction( $.fn.masonry ) ) {
			return;
		}

		var widgetArea = $( '#secondary .inner' );
		widgetArea.masonry( {
			itemSelector: '.widget',
			columnWidth: 320,
			gutterWidth: 0,
			isRTL: body.is( '.rtl' )
		} );

		if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh  ) {
			wp.customize.selectiveRefresh.bind( 'sidebar-updated', function( sidebarPartial ) {
				if ( 'footer' === sidebarPartial.sidebarId ) {
					widgetArea.masonry( 'reloadItems' );
					widgetArea.masonry( 'layout' );
				}
			} );
		}
	});
} )( jQuery );