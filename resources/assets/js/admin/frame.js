
/*
 *	Page preloader
 */
jQuery.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

jQuery(window).load(function() {

	jQuery('#status').fadeOut();
	jQuery('#preloader').delay(350).fadeOut(function(){
		jQuery('body').delay(350).css({'overflow':'visible'});
	});

});

/*
 *	Page general nav
 */
jQuery(document).ready(function() {

	// Toggle Left Menu
	jQuery('.nav-parent > a').click(function() {

		var parent = jQuery(this).parent();
		var sub = parent.find('> ul');

		// Dropdown works only when leftpanel is not collapsed
		if(!jQuery('body').hasClass('leftpanel-collapsed')) {
			if(sub.is(':visible')) {
				sub.slideUp(200, function(){
					parent.removeClass('nav-active');
					jQuery('.mainpanel').css({height: ''});
					adjustmainpanelheight();
				});
			} else {
				closeVisibleSubMenu();
				parent.addClass('nav-active');
				sub.slideDown(200, function(){
					adjustmainpanelheight();
				});
			}
		}
		return false;
	});

	function closeVisibleSubMenu() {
		jQuery('.nav-parent').each(function() {
			var t = jQuery(this);
			if(t.hasClass('nav-active')) {
				t.find('> ul').slideUp(200, function(){
					t.removeClass('nav-active');
				});
			}
		});
	}

	// Adjust mainpanel height
	function adjustmainpanelheight() {
		var docHeight = jQuery(document).height();
		if(docHeight > jQuery('.mainpanel').height())
			jQuery('.mainpanel').height(docHeight);
	}

	// Add class everytime a mouse pointer hover over it
	jQuery('.nav-bracket > li').hover(
		function(){
			jQuery(this).addClass('nav-hover');
		}, 
		function(){
			jQuery(this).removeClass('nav-hover');
		}
	);

	// Menu Toggle
	jQuery('.menutoggle').click(function(){

		var body = jQuery('body');
		var bodypos = body.css('position');

		if(bodypos != 'relative') {
			if(!body.hasClass('leftpanel-collapsed')) {
				body.addClass('leftpanel-collapsed');
				jQuery('.nav-bracket ul').attr('style','');

				jQuery(this).addClass('menu-collapsed');

			} else {
				body.removeClass('leftpanel-collapsed chat-view');
				jQuery('.nav-bracket li.active ul').css({display: 'block'});

				jQuery(this).removeClass('menu-collapsed');
			}
		} else {
			
			if(body.hasClass('leftpanel-show'))
				body.removeClass('leftpanel-show');
			else
				body.addClass('leftpanel-show');

			adjustmainpanelheight();         
		}
	});


	/*
	 * Tooggle translation panel for some string on settings page
	 */
	if($('.translations-toogle').length > 0){
		$('.translations-toogle').click(function(){
			$(this).closest('.form-group').find('.translations').toggle();
		})
	}



});