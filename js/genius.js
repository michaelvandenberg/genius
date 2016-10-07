/**
 * Genius.js
 *
 * Some custom scripts for this theme.
 */
( function( $ ) {

	// Check distance to top and display back-to-top.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 800) {
			$( '.back-to-top' ).addClass( 'show-back-to-top' );
		} else {
			$( '.back-to-top' ).removeClass( 'show-back-to-top' );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top, .search-toggle' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});

	// Open hidden header to reveal mobile menu.
	$( '.menu-toggle' ).click(function() {
		$( '#hidden-header' ).slideToggle( 'slow' );
		$( '.menu-toggle' ).toggleClass( 'menu-toggled' );

		// Change aria attritute.
		if ( $( this ).hasClass( 'menu-toggled' ) ) {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'true' );
		}
		else {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'false' );
		}
	});

	// Open hidden header to reveal desktop search.
	$( '#search-toggle a' ).click(function() {
		$( '#hidden-header' ).slideToggle( 'slow' );
	});

	// Add a focus class to sub menu items with children.
	$( '.menu-item-has-children' ).on( 'focusin focusout', function() {
		$( this ).toggleClass( 'focus' );
	});

	$( window ).load( function() {

		// Portfolio filtering
		var $container = $( '.portfolio-wrapper' );

		$container.isotope( {
			filter: '*',
			itemSelector: '.portfolio-item',
			layoutMode: 'fitRows',
			resizable: true,
			percentPosition: true,
			fitRows: {
				gutter: '.gutter-sizer'
			}
		  } );

		// filter items when filter link is clicked
		$( '.portfolio-filter li' ).click( function(){
			var selector = $( this ).attr( 'data-filter' );
				$container.isotope( { 
					filter: selector,
				} );
			$( '.portfolio-filter li' ).removeClass( 'active' );
			$( this ).addClass( 'active' );

		  return false;
		} );
	} );

})( jQuery );