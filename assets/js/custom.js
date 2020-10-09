jQuery(document).ready(function( $ ){
	jQuery('.products .product .size-woocommerce_thumbnail').wrap('<div class="img-thumb-parent"></div>');
	// is-checked
	jQuery('#filters .button').on('click', function(){

		jQuery('#filters .button').removeClass('is-checked'); 
		jQuery(this).addClass('is-checked'); 
	 
	 });
});

var $ = jQuery.noConflict();

// init Isotope
var $grid = $('.stage').isotope({
	itemSelector: '.stage li',
	layoutMode: 'fitRows',
	getSortData: {
		name: '.name',
		symbol: '.symbol',
		number: '.number parseInt',
		category: '[data-category]',
		weight: function( itemElem ) {
			var weight = $( itemElem ).find('.weight').text();
			return parseFloat( weight.replace( /[\(\)]/g, '') );
		}
	}
});

// bind filter button click
$('#filters').on( 'click', 'a', function() {
	var filterValue = $( this ).attr('data-filter');
	// use filterFn if matches value
	//filterValue = filterFns[ filterValue ] || filterValue;
	$grid.isotope({ filter: filterValue });
});


// Off canvas Menu
$(function() {      
    $('.toggle-nav').click(function() {        
        toggleNav();
    });  
});

function toggleNav() {
    if ($('body').hasClass('show-nav')) {        
        $('body').removeClass('show-nav');
    } else {
        
        $('body').addClass('show-nav');
    }  
}