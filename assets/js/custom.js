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
$('#filters').on( 'click', 'button', function() {
	var filterValue = $( this ).attr('data-filter');
	// use filterFn if matches value
	//filterValue = filterFns[ filterValue ] || filterValue;
	$grid.isotope({ filter: filterValue });
});