jQuery(document).ready(function( $ ){
	jQuery('.products .product .size-woocommerce_thumbnail').wrap('<div class="img-thumb-parent"></div>');
	jQuery('.products .product .wp-post-image').wrap('<div class="img-thumb-parent"></div>');
	// is-checked
	jQuery('#filters .button').on('click', function(){

		jQuery('#filters .button').removeClass('is-checked'); 
		jQuery(this).addClass('is-checked'); 
	 
	 });

	   //$('.woocommerce-mini-cart__empty-message').closest('.elementor-menu-cart__main').addClass('empty_cart_sidebar');

	$('#elementor-menu-cart__toggle_button').on('click', function() {
		if($('.elementor-menu-cart__main').find('.woocommerce-mini-cart__empty-message').length > 0) {
        	$('.elementor-menu-cart__main').addClass('empty_cart_sidebar')
        } else {
        	$('.elementor-menu-cart__main').removeClass('empty_cart_sidebar')
        }
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
jQuery(document).ready(function( $ ){
	jQuery('.products .product .size-woocommerce_thumbnail').wrap('<div class="img-thumb-parent"></div>');
	jQuery('.products .product .wp-post-image').wrap('<div class="img-thumb-parent"></div>');
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
