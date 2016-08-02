
//CallBack Image Select done
var cbIsDone = null;

jQuery(function($){

	/*
	 * Process navigation disabling
	 */
	if($('.nav-disabled').length > 0){
		$('.nav-disabled').click(function(e){
			e.preventDefault();
		});
	}

	/*
	 * Process language functions on settings/languages page
	 */
	if($('.panel-lang-list').length > 0){

		var flagsSrc = $('.panel-lang-list').data('flags-path');

		$('#edit-lang-dropdown option, #add-lang-dropdown option').each(function(index, option){
			$(option).attr('data-content', '<img style="width: 25px; margin-right: 5px;" src="' + flagsSrc + $(option).text() + '.svg"> ' + $(option).text());
		});
		
		//
		//

		//Add languade form showing
		$('.btn-lang-add').click(function(){
			$('.panel-lang-list').addClass('col-sm-8');
			$('.panel-lang-edit').hide();
			$('#add-lang-dropdown').selectpicker();
			$('.panel-lang-add').slideDown(400);
		});


		//Edit languade form showing
		var currentlyEdited = null;

		$(document).on('click', '.btn-lang-edit', function(event){
			event.preventDefault();
			
			$('.panel-lang-list').addClass('col-sm-8');
			$('.panel-lang-add').hide();
			//$('.panel-lang-edit').hide();

			var row = $(this).closest('tr');

			currentlyEdited = row;

			$('input[name="editlang_name"]').val(row.find('.data-name').text());
			$('input[name="editlang_code"]').val(row.find('.data-code').text());

			var flagCode = row.attr('data-flag');

			var selectedIndex = 0;

			var dd = $('#edit-lang-dropdown');
			
			dd.find('option').each(function(i, e){
				if($(e).text().toLowerCase() == flagCode){
					selectedIndex = i;
				}
			});

			$('#edit-lang-dropdown').selectpicker();
			
			dd.selectpicker('val', selectedIndex);

			$('.panel-lang-edit').slideDown(400, function(){
			});
		});

		$(document).on('click', '.btn-lang-remove', function(event){
			event.preventDefault();

			var body = $(this).closest('tbody');
			$(this).closest('tr').slideUp(200, function(){
				$(this).remove();
				body.find('.pos-id').each(function (i) {
					$(this).text(i + 1);
				});
			});
		});


		//Language sorting		
		var fixHelperModified = function(e, tr) {
			var $originals = tr.children();
			var $helper = tr.clone();
			$helper.children().each(function(index) {
				$(this).width($originals.eq(index).width())
			});
			return $helper;
		},
		updateTableSortIndex = function(e, ui) {
			$('td .pos-id', ui.item.parent()).each(function (i) {
				$(this).text(i + 1);
			});
		};
		var langTableSortable = function(){ 
			$("#lang-sort tbody")
			.sortable({
				helper: fixHelperModified,
				stop: updateTableSortIndex
			})
			.disableSelection();
		};
		langTableSortable();
		//End language sorting

		//Add new language submit processing
		$('.btn-lang-add-submit').click(function(){
			var p = $('.panel-lang-add');

			p.find('.form-group').removeClass('has-error')

			var nameObj = p.find('input[name="newlang_name"]');
			var codeObj = p.find('input[name="newlang_code"]');
			var flagObj = p.find('#add-lang-dropdown');

			var flagCode = flagObj.find('option[value="'+flagObj.val()+'"]').text().toLowerCase();

			if((nameObj.val().length > 1) && (codeObj.val().length == 2)){
				var html = '';

				html += '<tr data-flag="'+flagCode+'">';
				html += '<td>';
				html += '<i class="fa fa-sort"></i> &nbsp;&nbsp;&nbsp; ';
				html += '<span class="pos-id">' + ($('#lang-sort .pos-id').length + 1) +'</span>';
				html += '</td>';
				html += '<td class="data-name">'+nameObj.val()+'</td>';
				html += '<td class="data-code">'+codeObj.val().toLowerCase()+'</td>';
				html += '<td class="data-flag">';
				html += '<span class="flag-icon flag-icon-'+flagCode+'"></span>';
				html += '</td>';
				html += '<td class="table-action">';
				html += '<a class="btn-lang-edit" href="#"><i class="fa fa-pencil"></i></a>';
				html += '<a class="btn-lang-remove" href="#"><i class="fa fa fa-trash-o"></i></a>';
				html += '</td>';
				html += '</tr>';

				$("#lang-sort tbody").append(html);

				langTableSortable();

				p.find('#add-lang-dropdown').selectpicker('val', 0);

				p.slideUp(200, function(){
					nameObj.val('');
					codeObj.val('');
					$('#add-lang-dropdown').prop('selectedIndex', 0);
					
					$('.panel-lang-list').removeClass('col-sm-8');
				});

			}else{
				if(nameObj.val().length <= 1){
					nameObj.closest('.form-group').addClass('has-error');
				}

				if(codeObj.val().length !== 2){
					codeObj.closest('.form-group').addClass('has-error');
				}
			}

		});

		//Save edit language processing
		$('.btn-lang-edit-submit').click(function(){
			var p = $('.panel-lang-edit');

			p.find('.form-group').removeClass('has-error')

			var nameObj = p.find('input[name="editlang_name"]');
			var flagObj = p.find('#edit-lang-dropdown');

			var flagCode = flagObj.find('option[value="'+flagObj.val()+'"]').text().toLowerCase();

			if(nameObj.val().length > 1){
				if(currentlyEdited != null)
				{
					row = currentlyEdited;
					row.find('.data-name').text($('input[name="editlang_name"]').val());
					row.attr('data-flag', flagCode);
					row.find('.flag-icon').attr('class', 'flag-icon flag-icon-' + flagCode);

					p.slideUp(200, function(){
						nameObj.val('');
						
						$('.panel-lang-list').removeClass('col-sm-8');
					});
				}

			}else{
				nameObj.closest('.form-group').addClass('has-error');
			}
		});

		$('.panel-add-close').click(function(){
			$('.panel-lang-add').hide();
			$('.panel-lang-list').removeClass('col-sm-8');
		});
		$('.panel-edit-close').click(function(){
			$('.panel-lang-edit').hide();
			$('.panel-lang-list').removeClass('col-sm-8');
		});

		$('.btn-save-languages').click(function(){
			var btn = $(this);
			btn.css('width', btn.width() + 32);

			btn.find('.lbl').hide();
			btn.find('.fa-spinner').show();


			var list = new Array();

			$('.panel-lang-list tbody tr').each(function(i, e){
				var item = {};

				item.name = $(e).find('.data-name').text();
				item.code = $(e).find('.data-code').text();
				item.flag = $(e).data('flag');

				list.push(item)
			});

			$.post($('.panel-lang-list').attr('data-save-url'), {
				list : list
			}, function(response){
				if(response == '1'){
					jQuery.gritter.add({
						title: 'Languages saved!',
						text: 'To ensure this you can reload this page.',
						class_name: 'growl-primary',
						sticky: false,
					});
				}else{
					jQuery.gritter.add({
						title: 'Failed to save language!',
						text: 'Have errors while save languges list. Please reload page and edit again!',
						class_name: 'growl-danger',
						sticky: false,
					});
				}
				btn.find('.lbl').show();
				btn.find('.fa-spinner').hide();
				btn.removeAttr('style');
			});
  
		});
	}

	/*
	 * Process strin translations on settings/strings page
	 */
	if($('.settings-strings').length > 0){

		$('.btn-show').click(function(event){
			
			event.preventDefault();

			$('.settings-strings > .panel').hide();

			$('.settings-strings > .panel').filter('[data-panel="'+$(this).attr('data-target')+'"]').slideDown(400);

			$('.btn-show').removeClass('text-success');
			$(this).addClass('text-success').blur();
		});

	}

	if($('.image-select').length > 0)
	{
		$(document).on('click', '.is-on', function(){
			$('html').css({height: $(window).height(), overflow: 'hidden'});
			$('.image-select').show();
		});

		$(document).on('click', '.is-off', function(){
			$('html').removeAttr('style');
			$('.image-select').hide();
		});

		$(document).on('click', '.is-done', function(){
			if(cbIsDone != null)
			{
				cbIsDone();
			}
			$('.image-select .image.selected').removeClass('selected');
			$('.image-select').hide();
			$('html').removeAttr('style');
		});

		$(document).on('click', '.image-select .image', function(){
			if($(this).hasClass('selected'))
			{
				$(this).removeClass('selected')
			}
			else{
				$(this).addClass('selected')
			}
		});
	}



	//Toogles
	$('.toggle').each(function(i, e){
		$(e).toggles({
			text: {on:'Yes', off:'No'},
			checkbox: $('#' + $(e).attr('data-checkbox-id')),
			on: $('#' + $(e).attr('data-checkbox-id')).is(':checked')
		});
    });



    if($('.theme-option').length > 0)
    {
		$.propHooks.checked = {
		    set: function (el, value) {
		        if (el.checked !== value) {
		            el.checked = value;
		            $(el).trigger('change');
		        }
		    }
		};

    	//Process loaded state
    	$('.theme-option .option-toggle-cb').each(function(i,e){
    		if($(e).attr('checked'))
    		{
    			$(e).closest('.theme-option').find('.option-control').show();
    		}else{
    			$(e).closest('.theme-option').find('.option-control').hide();
    		}
    	});

    	$(document).on('change', '.option-toggle-cb', function(){
    		if($(this).attr('checked'))
    		{
    			$(this).closest('.theme-option').find('.option-control').show();
    		}else{
    			$(this).closest('.theme-option').find('.option-control').hide();
    		}
    	});

    }

    window.buildImageSelector = function()
    {
		//Image
		$('.to-image').each(function(){
			var selectImage = function(element){
				var c = $(element).closest('.to-image');
	    		cbIsDone = function(){
	    			var url = $('.image-select .image.selected').eq(0).attr('data-url');
	    			var id = $('.image-select .image.selected').eq(0).attr('data-id');
	    			if(url != '')
	    			{
	    				c.find('.to-image-input').val(id);
	    				c.find('.to-image-value').attr('src', url);
	    				c.addClass('has-value');
	    			}
	    			cbIsDone = null;
	    		};
				$('.image-select').show();
			};

			$(this).find('.add').click(function(e){
				e.preventDefault();
				console.log(this);
				selectImage(this);
			});
			$(this).find('.remove').click(function(e){
				var c = $(this).closest('.to-image');
				c.find('.to-image-input').val('');
				c.find('.to-image-value').attr('src', '');
				c.removeClass('has-value');
			});

			$(this).find('.refresh').click(function(e){
				e.preventDefault();
				selectImage(this);
			});
		});
    }
    buildImageSelector();
});