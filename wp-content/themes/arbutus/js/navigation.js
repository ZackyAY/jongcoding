/**
 * File navigation.js.
 *
 * Enables keyboard navigation support for dropdown menus.
 */
( function() {
	var container, menu, links, subMenus, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Get all of the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, false );
		links[i].addEventListener( 'blur', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus( event ) {
		var self = this, parent = self.parentElement;

		// This function is run on menu item links; verify the parent is an li.
		if ( 'li' === parent.localName ) {

			// Remove focus from adjacent parent menu items if this is a top-level item. 1: verify ul; 2: verify menu, not sub-menu
			if ( 'ul' === parent.parentElement.localName 
				&& -1 === parent.parentElement.className.indexOf( 'sub-menu' ) ) {
				if ( parent.nextElementSibling ) {
					parent.nextElementSibling.className = parent.nextElementSibling.className.replace( ' focus', '' );
				}
				if ( parent.previousElementSibling ) {
					parent.previousElementSibling.className = parent.previousElementSibling.className.replace( ' focus', '' );
				}
			}

			// Is the current link a direct submenu parent?
			if ( -1 !== parent.className.indexOf( 'menu-item-has-children' ) ) {

				// Add focus as needed.
				if ( 'focus' === event.type && -1 === parent.className.indexOf( 'focus' ) ) {
					parent.className = parent.className + ' focus';
				}
			}

			// If we leave the menu, close all submenus.
			if ( event.relatedTarget && 'li' !== event.relatedTarget.parentElement.localName ) {
				for ( i = 0, len = subMenus.length; i < len; i++ ) {
					subMenus[i].parentElement.className = subMenus[i].parentElement.className.replace( ' focus', '' );
				}
			}
		} else {
			return;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
