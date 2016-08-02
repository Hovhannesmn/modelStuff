<script src="{!! url('assets/vendor/tinymce/tinymce.min.js') !!}"></script>
<script src="{!! url('assets/admin/js/tinymce-cms.js') !!}"></script>
<script>


	tinymce.init({
		selector:'#page-content',
		content_css: [
			'{{ url("assets/t/".Theme::active()."/css/frontend.css") }}'
		],
		menubar: false,
		plugins: "fullscreen, media, image, link, visualblocks, code, cms",
		toolbar: [
			"undo redo | alignleft aligncenter alignright custom_format | bold italic | visualblocks code fullscreen",
			"media link image row col"
		],
    	image_advtab: true,
        forced_root_block: false,
        convert_urls: false,
        height : 300
	});



	jQuery(function($){
		var tinyInit = function(element)
		{	
			if($('.ca-link .item').length == 0)
			{
				$('.page-dynamic').hide();
			}
			else
			{
				$('.page-dynamic').show();
			}

			if($('.ca-link .item.active').length > 0)
			{
				$('.ca-link .item.active textarea').val(tinyMCE.activeEditor.getContent());
				$('.ca-link .item.active').removeClass('active');
			}
			if(element)
			{
				var elementValue = element.find('textarea').val();
				elementValue = elementValue == undefined?'':elementValue;
				
				tinyMCE.activeEditor.setContent(elementValue);
				
				element.addClass('active');
			}
		}

		var refreshDynamicContent = function(template)
		{
			$.ajax({
				method: 'POST',
				url: '{!! url("admin/pages/dynamic") !!}',
				data: {
					template: template,
					page: {!! $page->id?$page->id:0 !!},
				},
				success: function(result){
					var obj = $(result);

					$('.pd-render').html('<div class="ca-link mb15">' + obj.find('.ca-link').html() + '</div>');
					$('.options-dynamic').html(obj.find('.options').html());

					setTimeout(function(){
						buildImageSelector();
						tinyInit($('.ca-link .item:first-of-type'));
					}, 300);
				}
			});
		}

		$(document).on('click', '.ca-link .item a', function(e){
			e.preventDefault();
			tinyInit($(this).closest('.item'));
		});

		$(document).on('change', 'select[name="settings[template]"]', function(){
			refreshDynamicContent($(this).val());
		});

		$('form').submit(function(e){
			tinyInit(null);
			$('textarea[name="content-editor"').remove();
			$('select[name="settings[template]"').removeAttr('disabled');
		});

		if($('.page-dynamic').length > 0 || $('.options-dynamic').length > 0){
			refreshDynamicContent($('select[name="settings[template]"]').val());
		}
		else{
			setTimeout(function(){
				tinyInit($('.ca-link .item:first-of-type'));
			}, 800);
		}
	});

</script>