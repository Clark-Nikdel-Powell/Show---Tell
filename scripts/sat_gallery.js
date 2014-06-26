// This will be cleaned up a good bit, later.
jQuery(function($){

	$('.sat-gallery .image, .sat-gallery .captions p').hide();
	$('.sat-gallery .images .image:first-child, .sat-gallery .captions p:first-child').show().addClass('active');

	var index = 1;
	var total = $('.sat-gallery .image').length;
	if (total == 1) {$('.sat-gallery .sat-next, .sat-gallery .sat-back').hide(); $('.sat-gallery .caption').css('min-height','1px');}
	if (total > 1) {$('<p class="sat-count"><span class="current">'+index+'</span>/'+total+'</p>').appendTo('.sat-nav');}


	$('.sat-gallery .sat-next').click(function() {
		if($('.sat-gallery .image.active').is(":animated")){return false;}
		if ($('.sat-gallery .image').length == index) {
			$('.sat-gallery .image.active').fadeOut(250, 'linear').removeClass('active');
			$('.sat-gallery .images .image:first-child').fadeIn(250, 'linear').addClass('active');
			$('.sat-gallery p.active').hide().removeClass('active').next('p').show().addClass('active');
			$('.sat-gallery .captions p:first-child').appendTo('.captions');
			index = 1;
			$('.sat-count .current').html(index)
		}	else {
		$('.sat-gallery .image.active').fadeOut(250, 'linear').removeClass('active').next('.image').fadeIn(250, 'linear').addClass('active');
		index++;
		$('.sat-count .current').html(index);
		$('.sat-gallery p.active').hide().removeClass('active').next('p').show().addClass('active');
		$('.sat-gallery .captions p:first-child').appendTo('.sat-gallery .captions');
		}
		return false;
	});

	$('.sat-gallery .sat-back').click(function() {
		if($('.sat-gallery .image.active').is(":animated")){return false;}
		if (index == 1) {
			$('.sat-gallery .image.active').fadeOut(250, 'linear').removeClass('active');
			$('.sat-gallery .image').last().fadeIn(250, 'linear').addClass('active');
			$('.sat-gallery p.active').hide().removeClass('active');
			$('.sat-gallery .captions p:last-child').show().addClass('active').prependTo('.captions');
			index = $('.sat-gallery .image').length;
			$('.sat-count .current').html(index)
		}	else {
		$('.sat-gallery .image.active').fadeOut(250, 'linear').removeClass('active').prev().fadeIn(250, 'linear').addClass('active');
		$('.sat-gallery p.active').hide().removeClass('active');
		$('.sat-gallery .captions p:last-child').show().addClass('active').prependTo('.sat-gallery .captions');
		index--;
		$('.sat-count .current').html(index)
		}
		return false;
	});

	// Keep an aspect ratio of 16:9 no matter how big/small it is.
	$(window).on('load resize', function() {

		var gallery = $('.sat-gallery');
		var galleryWidth = gallery.outerWidth();
		var correctHeight = (galleryWidth*9)/16;

		$('.sat-gallery .images').css('height', correctHeight);

	});

});
