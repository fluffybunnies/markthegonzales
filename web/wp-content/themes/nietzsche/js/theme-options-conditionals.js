+( function( $ ) {

	"use strict";

	$( function() {

		var $header_type = $( '#pe_theme_options_header_type_' ),
			$menu_type = $( '#pe_theme_options_menu_type_' ),
			$menu_logo = $( '#pe_theme_options_menu_logo_' ).closest( '.option' ),
			$alternative_logo = $( '#pe_theme_options_alternative_logo_' ).closest( '.option' ),
			$menu_icons = $( '#pe_theme_options_menu_icons_' ),
			$menu_bg = $( '#pe_theme_options_menu_bg_' ).closest( '.option' );

		function show_relevant_header_options() {

			switch ( $menu_type.val() ) {

				case ( 'overlay' ) :

					$menu_icons.hide();
					$menu_logo.hide();
					$menu_bg.hide();

					break;

				default :

					$menu_icons.show();
					$menu_logo.show();
					$menu_bg.show();

					break;

			}

			switch ( $header_type.val() ) {

				case ( 'top-transparent' ) :
				case ( 'bottom-transparent' ) :

					$alternative_logo.show();

					break;

				default :

					$alternative_logo.hide();

					break;

			}

		}

		show_relevant_header_options();

		$menu_type.on( 'change', show_relevant_header_options );
		$header_type.on( 'change', show_relevant_header_options );

	});

})( jQuery );