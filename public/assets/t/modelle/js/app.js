jQuery(function($){
	if($('section.page').length > 0)
	{
		$(window).resize(function(){
			$('section.page').css({
				'padding-top' : $('header.page').height(),
				'padding-bottom' : $('footer.page').height()
			});
		}).trigger('resize');
	}

	if($('.profile-image, .profile-picture').length > 0)
	{
		var pswpElement = document.querySelectorAll('.pswp')[0];

		$('.profile-image, .profile-picture').click(function(){
			var items = new Array();
			var start_index = 0;
			var clicked = $(this);
			$('.profile-image, .profile-picture').each(function(i, e){
				items.push({
					src: $(e).attr('data-img'),
					w: $(e).attr('data-w'),
					h: $(e).attr('data-h')
				});
				if($(e).attr('data-img') == clicked.attr('data-img')){
					start_index = i;
				}
			});
			var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, {index: start_index});
			gallery.init();
		});
	}

	if($('.gallery').length > 0)
	{
		var pswpElement = document.querySelectorAll('.pswp')[0];

		$('.gallery a').click(function(){
			var items = new Array();
			var start_index = 0;
			var clicked = $(this);
			$('.gallery a').each(function(i, e){
				items.push({
					src: $(e).attr('data-img'),
					w: $(e).attr('data-w'),
					h: $(e).attr('data-h')
				});
				if($(e).attr('data-img') == clicked.attr('data-img')){
					start_index = i;
				}
			});
			var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, {index: start_index});
			gallery.init();
		});
	}
}); 