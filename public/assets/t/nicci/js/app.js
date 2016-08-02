$(function() {
	if($(".slider").length > 0)
	{
		var s = $(".slider").slippry({
			adaptiveHeight: false,
			captions: false
		});

		$(window).resize(function(){
			s.refresh();
		});
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
});