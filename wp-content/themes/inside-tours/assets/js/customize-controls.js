( function( api ) {

	// Extends our custom "inside-tours" section.
	api.sectionConstructor['inside-tours'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );