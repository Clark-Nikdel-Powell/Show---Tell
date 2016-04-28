// This will be cleaned up a good bit, later.
jQuery(function($){

	$('.sat-gallery .image, .sat-gallery .captions p').hide();
	$('.sat-gallery .images .image:first-child, .sat-gallery .captions p:first-child').show().addClass('active');

	$('.sat-gallery').each(function(index, el) {
		var id = $(this).attr('id');
		id = "#"+id;

		var index = 1;
		var total = $(id + ' .image').length;

		if (total == 1) {
			$(id + ' .sat-next, ' + id + ' .sat-back').hide()
			$(id + ' .caption').css('min-height','1px');
		}
		if (total > 1) {$('<p class="sat-count"><span class="current">'+index+'</span>/'+total+'</p>').prependTo(id + ' .caption');}
	});

	var index = 1;

	function sat_init() {

		if ($(".sat-gallery").attr('data-autoplay') == 'true') {
			setInterval(sat_forward,6000);
		}

		var gallery = $('.sat-gallery');
		var galleryWidth = gallery.outerWidth();
		var correctHeight = (galleryWidth*9)/16;

		$('.sat-gallery .images').css('height', correctHeight);

	}

	////////////////////////////////////////////////////////
	// Forwards Function  /////////////////////////////////
	//////////////////////////////////////////////////////

	function sat_forwards() {

		var id = $(this).parents('.sat-gallery').attr('id');
		id = "#"+id;

		if ($(id + ' .image.active').is(":animated")){return false;}

		var current = $(id + ' .image.active').index();
		var next = current + 1;
		var current_number = current + 2;

		// If we're at the end, go back to the beginning.
		if (current == $(id + ' .image').length - 1) {
			next = 0;
			current_number = 1;
		}

		// Change out images
		$(id + ' .image').eq(current).fadeOut(250, 'linear').removeClass('active');
		$(id + ' .image').eq(next).fadeIn(250, 'linear').addClass('active');

		// Change out captions
		$(id + ' .captions p').eq(current).hide().removeClass('active');
		$(id + ' .captions p').eq(next).show().addClass('active');

		// Update Current Number
		$(id + ' .sat-count .current').html(current_number);

		return false;
	}
	// Run function on click
	$('.sat-gallery .sat-next').on('click', sat_forwards );


	////////////////////////////////////////////////////////
	// Backwards Function  ////////////////////////////////
	//////////////////////////////////////////////////////

	// Combine with forwards function eventually.
	function sat_backwards() {

		var id = $(this).parents('.sat-gallery').attr('id');
		id = "#"+id;

		if ($(id + ' .image.active').is(":animated")){return false;}

		var current = $(id + ' .image.active').index();
		var prev = current - 1;
		var current_number = current;

		// If we're at the beginning, go back to the end.
		if (current == 0) {
			prev = $(id + ' .image').length - 1;
			current_number = $(id + ' .image').length;
		}

		// Change out images
		$(id + ' .image').eq(current).fadeOut(250, 'linear').removeClass('active');
		$(id + ' .image').eq(prev).fadeIn(250, 'linear').addClass('active');

		// Change out captions
		$(id + ' .captions p').eq(current).hide().removeClass('active');
		$(id + ' .captions p').eq(prev).show().addClass('active');

		// Update Current Number
		$(id + ' .sat-count .current').html(current_number);

		return false;
	}
	// Run function on click
	$('.sat-gallery .sat-back').on('click', sat_backwards );

	// Keep an aspect ratio of 16:9 no matter how big/small it is.
	$(window).on('load resize', function() {

		sat_init();

	});

	/*//////////////////////////////////////////////////////
	//  VIDEOS  ///////////////////////////////////////////
	////////////////////////////////////////////////////*/

	function pauseAll() {
	    $('iframe[src*="vimeo.com"]').each(function () {
	        $f(this).api('pause');
	    });
	}

	$(".sat-next, .sat-back").on("click", function(){
		pauseAll();
		return false;
	});

	sat_init();

});
