+( function( $ ) {

	"use strict";

	var $window = $( window ),
		$html = $( 'html' ),
		$body = $( 'body' );

	$window.on( 'load', function() {

		$window.resize();

	});

	$( function() {

		// contact form
		if ( $( '.peThemeContactForm' ).length > 0 ) {

			$( '.peThemeContactForm' ).peThemeContactForm();

		}

		// add section id to blog pagination links
		$( '.section-type-blog-grid, .section-type-blog' ).each( function() {

			var $section = $( this ),
				id = $section.attr( 'id' ),
				$pagination = $section.next( '.pagination-1' );

			if ( $pagination.length && undefined !== id ) {

				$pagination
					.find( 'a' )
						.each( function() {

							var $link = $( this );

							$link.attr( 'href', $link.attr( 'href' ) + '#' + id );

						});

			}

		});

		// Apply background image to :before element on google maps builder block
		$body
			.find( '.section-type-google-map.hero-7' )
				.each( function() {

					var $this = $( this ),
						$background = $this.find( '.background-cover' ).first(),
						background = $background.attr( 'data-bg-image' ),
						id = $this.attr( 'id' );

					if ( ! background ) {

						return;

					} else {

						var style = '#' + id + ' > .row:before { background-image: url( ' + background + ' ); }';

						$this.prepend( '<style type="text/css">' + style + '</style>' );

					}

				});

		// Custom styles for hero block :before and :after
		$body
			.find( '.section-type-hero' )
				.each( function() {

					var $this = $( this ),
						$row = $this.children( '.row' ),
						backgroundColor1 = $this.attr( 'data-bg-color-1' ),
						backgroundImage1 = $this.attr( 'data-bg-image-1' ),
						opacity1 = $this.attr( 'data-opacity-1' ),
						backgroundColor2 = $this.attr( 'data-bg-color-2' ),
						backgroundImage2 = $this.attr( 'data-bg-image-2' ),
						opacity2 = $this.attr( 'data-opacity-2' ),
						id = $this.attr( 'id' );

					if ( ! backgroundColor1 && ! backgroundImage1 && ! opacity1 && ! backgroundColor2 && ! backgroundImage2 && ! opacity2 ) {

						return;

					} else {

						var style = '';

						if ( backgroundColor1 || backgroundImage1 || opacity1 ) {

							style += '#' + id + ' > .row:before {'

							if ( backgroundColor1 ) {

								style += 'background-color: ' + backgroundColor1 + ';'

							}

							if ( backgroundImage1 ) {

								style += 'background-image: url( ' + backgroundImage1 + ' );'

							}

							if ( opacity1 ) {

								style += 'opacity: ' + opacity1 + ';'

							}

							style += '}';

						}


						if ( backgroundColor2 || backgroundImage2 || opacity2 ) {

							style += '#' + id + ' > .row:after {'

							if ( backgroundColor2 ) {

								style += 'background-color: ' + backgroundColor2 + ';'

							}

							if ( backgroundImage2 ) {

								style += 'background-image: url( ' + backgroundImage2 + ' );'

							}

							if ( opacity2 ) {

								style += 'opacity: ' + opacity2 + ';'

							}

							style += '}';

						}

						$this.prepend( '<style type="text/css">' + style + '</style>' );

					}

					// resize the .row properly based on the height of the parent (min-height fix)
					function resizeRow() {

						$row.height( 'auto' ).height( $this.height() );

					}

					resizeRow();

					$window.on( 'load resize', resizeRow );

				});

		$body.on( 'click', 'a.disabled[href="#"]', function( e ) {

			e.preventDefault();

		});

	});

})( jQuery );