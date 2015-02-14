jQuery( document ).ready( function ($)
{	
	// Insert the criteria buttons
	$('div.inside > div.omc_clear_that_thang').before('<br style="clear:both" /><div style="height:40px"></div>');
	$('div.inside > div.omc_add_criteria1').before('<div class="omc_add_another omc_add_another_1">Add Criteria One</div>');
	$('div.inside > div.omc_add_criteria2').before('<div class="omc_add_another omc_add_another_2">Add Criteria Two</div>');
	$('div.inside > div.omc_add_criteria3').before('<div class="omc_add_another omc_add_another_3">Add Criteria Three</div>');
	$('div.inside > div.omc_add_criteria4').before('<div class="omc_add_another omc_add_another_4">Add Criteria Four</div>');
	$('div.inside > div.omc_add_criteria5').before('<div class="omc_add_another omc_add_another_5">Add Criteria Five</div>');
	$('div.inside > div.omc_add_criteria6').before('<div class="omc_add_another omc_add_another_6">Add Criteria Six</div>');

	//Wrap the criteria forms for visual purposes
	$('div.inside > div.omc_c1').wrapAll('<div class="omc_c1_wrapper omc_criteria_wrapper" />');
	$('div.inside > div.omc_c2').wrapAll('<div class="omc_c2_wrapper omc_criteria_wrapper" />');
	$('div.inside > div.omc_c3').wrapAll('<div class="omc_c3_wrapper omc_criteria_wrapper" />');
	$('div.inside > div.omc_c4').wrapAll('<div class="omc_c4_wrapper omc_criteria_wrapper" />');
	$('div.inside > div.omc_c5').wrapAll('<div class="omc_c5_wrapper omc_criteria_wrapper" />');
	$('div.inside > div.omc_c6').wrapAll('<div class="omc_c6_wrapper omc_criteria_wrapper" />');
	
	// Display the current percentage
	var init_rating = $('input#omc_final_score').val();
	init_percentage = init_rating * 20;
	$('p#omc_final_score_description em').text(init_percentage);	
	
	// get the values from the inputs to determince what gets displayed
	var rating_1a = $('input#omc_c1_rating').val();
	var rating_1b = $('input#omc_c1_description').val();	
	var rating_2a = $('input#omc_c2_rating').val();
	var rating_2b = $('input#omc_c2_description').val();	
	var rating_3a = $('input#omc_c3_rating').val();
	var rating_3b = $('input#omc_c3_description').val();	
	var rating_4a = $('input#omc_c4_rating').val();
	var rating_4b = $('input#omc_c4_description').val();	
	var rating_5a = $('input#omc_c5_rating').val();
	var rating_5b = $('input#omc_c5_description').val();	
	var rating_6a = $('input#omc_c6_rating').val();
	var rating_6b = $('input#omc_c6_description').val();
	
	
	// Hide the criteria
	$('.omc_criteria_wrapper').hide(1);
	
	// Control the display of the criteria
	if (rating_1a !== '' || rating_1b !== '' ) {
		$('.omc_c1_wrapper').fadeIn(1200);
		$('.omc_add_another_1').hide(1);
	} 	
	
	if ( rating_2a !== '' || rating_2b !== '' ) {
		$('.omc_c2_wrapper').fadeIn(1200);
		$('.omc_add_another_2').hide(1);
	} 	
	
	if ( rating_3a !== '' || rating_3b !== '' ) {
		$('.omc_c3_wrapper').fadeIn(1200);
		$('.omc_add_another_3').hide(1);
	} 	
	
	if ( rating_4a !== '' || rating_4b !== '' ) {
		$('.omc_c4_wrapper').fadeIn(1200);
		$('.omc_add_another_4').hide(1);
	} 	
	
	if ( rating_5a !== '' || rating_5b !== '' ) {
		$('.omc_c5_wrapper').fadeIn(1200);
		$('.omc_add_another_5').hide(1);
	} 	
	
	if ( rating_6a !== '' || rating_6b !== '' ) {
		$('.omc_c6_wrapper').fadeIn(1200);
		$('.omc_add_another_6').hide(1);
	} 
	
	// Add another Criteria Buttons (1) //
	$('.omc_add_another_1').click(function() {
		$('.omc_c1').addClass('enabled');
		$('.omc_c1_wrapper').fadeIn(1200);
		$(this).hide(0);
	});
	
	// Add another Criteria Buttons (2) //
	$('.omc_add_another_2').click(function() {
		$('.omc_c2').addClass('enabled');
		$('.omc_c2_wrapper').fadeIn(1200);
		$(this).hide(0);
	});
	
	// Add another Criteria Buttons (3) //
	$('.omc_add_another_3').click(function() {
		$('.omc_c3').addClass('enabled');
		$('.omc_c3_wrapper').fadeIn(1200);
		$(this).hide(0);
	});

	// Add another Criteria Buttons (4) //
	$('.omc_add_another_4').click(function() {
		$('.omc_c4').addClass('enabled');
		$('.omc_c4_wrapper').fadeIn(1200);
		$(this).hide(0);
	});

	// Add another Criteria Buttons (5) //
	$('.omc_add_another_5').click(function() {
		$('.omc_c5').addClass('enabled');
		$('.omc_c5_wrapper').fadeIn(1200);
		$(this).hide(0);
	});

	// Add another Criteria Buttons (6) //
	$('.omc_add_another_6').click(function() {
		$('.omc_c6').addClass('enabled');
		$('.omc_c6_wrapper').fadeIn(1200);
		$(this).hide(0);
	});
	
	
	// Do the calulations	
	$('input#omc_c1_rating, input#omc_c2_rating, input#omc_c3_rating, input#omc_c4_rating, input#omc_c5_rating, input#omc_c6_rating').change( function() {
		
		var divider	= 0;
		var final_score = 0;
	
		var rating_1 = $('input#omc_c1_rating').val();		
		var rating_2 = $('input#omc_c2_rating').val();		
		var rating_3 = $('input#omc_c3_rating').val();		
		var rating_4 = $('input#omc_c4_rating').val();		
		var rating_5 = $('input#omc_c5_rating').val();		
		var rating_6 = $('input#omc_c6_rating').val();
		
		if (rating_1 !== '') {divider = divider + 1;} else {rating_1 = 0;}
		if (rating_2 !== '') {divider = divider + 1;} else {rating_2 = 0;}
		if (rating_3 !== '') {divider = divider + 1;} else {rating_3 = 0;}
		if (rating_4 !== '') {divider = divider + 1;} else {rating_4 = 0;}
		if (rating_5 !== '') {divider = divider + 1;} else {rating_5 = 0;}
		if (rating_6 !== '') {divider = divider + 1;} else {rating_6 = 0;}		
	
		final_score =  parseFloat(rating_1) + parseFloat(rating_2) + parseFloat(rating_3) + parseFloat(rating_4) + parseFloat(rating_5) + parseFloat(rating_6) ;
		
		final_score = final_score / divider;
		
		final_score = Math.round(final_score*10)/10;
		
		percentage = final_score * 20;
		
		$('input#omc_final_score').val(final_score);		
		
		$('p#omc_final_score_description em').text(percentage);		
		
	});
	
	
	// Give a little preview for the percentage
	$('input#omc_c1_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_1').text(' (' +percent + '%)');			
	});
	
	$('input#omc_c2_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_2').text(' (' +percent + '%)');		
	});
	
	$('input#omc_c3_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_3').text(' (' +percent + '%)');		
	});
	
	$('input#omc_c4_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_4').text(' (' +percent + '%)');			
	});
	
	$('input#omc_c5_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_5').text(' (' +percent + '%)');			
	});
	
	$('input#omc_c6_rating').change( function() {	
		var rating = $(this).val();				
		percent = rating * 20;		
		$('em#omc_preview_rating_6').text(' (' +percent + '%)');			
	});
	
	
} );