@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.navigation') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.navigation') }}</li>
@endsection

@section('content')

<?php 

	$anchors = [
		[
			'area' 	=> 'example',
			'type' 	=> 'page',
			'title'	=>  [
				Languages::general() => ''
			],
			'value' => ''
		]
	];

	$anchors = array_merge($anchors, Navigation::all());

?>


	{!! Form::open(['method'=>'POST', 'action'=>'Admin\NavigationController@postIndex', 'class'=>'form-horizontal']) !!}
		
		@include('admin.partial.errors')

		<div class="row">
			<div class="col-sm-4 pull-right-sm">
				<div class="panel panel-default">
					<div class="panel-body">
						<label>{{ Languages::trans('admin.settings.navigation_area') }}:</label>
						{!! Form::select('area', Theme::areas('kv'), null, ['class'=>'form-control']) !!}
					</div>
					<div class="panel-footer">
						{!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<a class="btn btn-success btn-xs mb15 add-new" href="">+ {{ Languages::trans('general.buttons.add_new') }}</a>
				<div class="anchors">
					@foreach($anchors as $anchor)
						<div class="anchor" data-area="{{ $anchor['area'] }}">
							{!! Form::input('hidden', 'anchor[][area]', $anchor['area'], ['class'=>'input-area']) !!}
							<div class="form-group">
								<label class="col-sm-2 control-label">{{ Languages::trans('admin.settings.title') }}:</label>
								<div class="col-sm-9">
									<div class="input-group input-group-sm">
										<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
										{!! Form::text('anchor[][title]['.Languages::general().']', $anchor['title'][Languages::general()], ['class'=>'form-control title-'.Languages::general() ]) !!}
										<span class="input-group-addon translations-toogle"><i class="fa fa-flag"></i></span>
									</div>
									<div class="translations">
										<div class="mb15"></div>
										@foreach(Languages::allButGeneral() as $lang)
											<div class="input-group input-group-sm mb15">
												<span class="input-group-addon">{{ strtoupper($lang) }} :</span>
												@if(array_key_exists($lang, $anchor['title']))
													{!! Form::text('anchor[][title]['.$lang.']', $anchor['title'][$lang], ['class'=>'form-control title-'.$lang]) !!}
												@else
													{!! Form::text('anchor[][title]['.$lang.']', $anchor['title'][Languages::general()], ['class'=>'form-control title-'.$lang]) !!}
												@endif
											</div>
										@endforeach	
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">{{ Languages::trans('admin.settings.link_to') }}:</label>
								<div class="col-sm-9">
									{!! Form::select('anchor[][type]', ['page'=>'page','external'=>'external'], $anchor['type'] , ['class'=>'link-to form-control input-sm']) !!}
								</div>
							</div>
							<div class="form-group linkto-select page-select" style="display: none;">
								<label class="col-sm-2 control-label">{{ Languages::trans('admin.settings.page') }}:</label>
								<div class="col-sm-9">
									{!! Form::select('anchor[][value]', App\Page::allIdKey() , $anchor['value'] , ['class'=>'form-control page-select input-sm', 'placeholder'=>'Select page']) !!}
								</div>
							</div>
							<div class="form-group linkto-select external-select" style="display: none;">
								<label class="col-sm-2 control-label">{{ Languages::trans('admin.settings.enter_url') }}:</label>
								<div class="col-sm-9">
									{!! Form::text('anchor[][value]', $anchor['value'] , ['class'=>'form-control input-sm']) !!}
								</div>
							</div>
							<a class="remove">X</a>
							<a class="drag"><i class="fa fa-arrows-alt"></i></a>
						</div>
					@endforeach	
				</div>
			</div>
		</div>

	{!! Form::close() !!}

@endsection

@section('footer-scripts')
	<style>
		@media (min-width: 768px) {
			.pull-right-sm {
				float: right;
			}
		}
		.anchor{
			padding: 30px 15px 15px 15px;
			border: 1px dotted #bbb;
			background: #fff;
			border-radius: 5px;
			margin-bottom: 15px;
			position: relative;
		}
		.anchor:last-of-type{
			margin-bottom: 0;
		}
		.anchor .remove{
			position: absolute;
			top: 5px;
			right: 10px;
			cursor: pointer;
			color: #888;
			text-decoration: none;
		}
		.anchor .drag{
			position: absolute;
			top: 5px;
			left: 7px;
			cursor: move;
			color: #bbb;
			text-decoration: none;		
		}
		.anchor .translations{
			display: none;
		}
		.anchor.show-trans .translations{
			display: block;
		}
	</style>
    <script type="text/javascript">
    	
    	<?php $pages = json_encode(App\Page::titles()); ?>
		
		var pages = jQuery.parseJSON('{!! $pages !!}');
	    var anch;
	    jQuery(function($){

	    	var makeSortable = function()
	    	{
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
	    		$('.anchors').sortable({
					helper: fixHelperModified,
					stop: updateTableSortIndex,
					handle: ".drag"
				})
	    	}

	    	var changeLinkTo = function(e, type)
	    	{
    			var anchorObj = $(e).closest('.anchor');
    			anchorObj.find('.linkto-select').hide();
    			anchorObj.find('div.'+type+'-select').show();
	    	}

	    	var changeArea = function()
	    	{
	    		var area = $('select[name="area"]').val();
	    		$('.anchor').each(function(i, e){
	    			if($(e).attr('data-area') != area){ $(e).hide(); }
	    			else{ $(e).show(); }
	    		});
	    	}

	    	var setPageTitles = function(anchorObj)
	    	{
	    		var selectedPage = anchorObj.find('select.page-select').eq(0).val();
	    		if(pages[selectedPage])
	    		{
	    			var pArr = pages[selectedPage];
	    			for(var i = 0; i < pArr.length; i++)
	    			{
	    				var tb = anchorObj.find('.title-'+pArr[i].lang);
	    				if(tb.length > 0)
	    				{
	    					tb.val(pArr[i].title);
	    				}
	    			}
	    		}
	    	}

	    	var init = function()
	    	{	
	    		//Prepare
	    		changeArea();

	    		$('.link-to').each(function(i, e){
	    			changeLinkTo(e, $(e).val());
	    		});

	    		//Events
	    		$(document).on('change', '.link-to', function(){
	    			var type = $(this).val();
	    			changeLinkTo(this, type);
	    			if(type == 'page')
	    			{
	    				setPageTitles($(this).closest('.anchor'));
	    			}
	    		});

	    		$(document).on('change', 'select[name="area"]', function(){
	    			changeArea();
	    		});

	    		$(document).on('change', 'select.page-select', function(){
	    			setPageTitles($(this).closest('.anchor'));
	    		});

	    		$(document).on('click', '.translations-toogle', function(){
	    			if($(this).closest('.anchor').hasClass('show-trans'))
	    			{
	    				$(this).closest('.anchor').removeClass('show-trans');
	    			}
	    			else
	    			{
	    				$(this).closest('.anchor').addClass('show-trans');
	    			}
	    		});

	    		$(document).on('click', '.remove', function(){
	    			$(this).closest('.anchor').remove();
	    		});

	    		$('.add-new').click(function(e){
	    			e.preventDefault();
	    			$(this).blur();

	    			var tpl = $('[data-area="example"]').eq(0).clone();

	    			
	    			$('.anchors').append(tpl);

	    			var area = $('select[name="area"]').val();
	    			tpl.attr('data-area', area).show();
	    			tpl.find('.link-to').val('').trigger('change');
	    			tpl.find('.input-area').val(area);
	    		});

	    		$('form').submit(function(e){
	    			//e.preventDefault();

	    			var index = 0;
	    			$('.anchor').each(function(i,e){
	    				if($(e).attr('data-area') == 'example')
	    				{
	    					$(e).remove();
	    					return;
	    				}

	    				var type = $(e).find('.link-to').val();
	    				$(e).find('.linkto-select').not('.'+type+'-select').remove();

	    				$(e).find('select, input').each(function(i, e){
	    					$(e).attr('name', $(e).attr('name').replace('anchor[]', 'anchor['+index+']') );

	    					console.log($(e).attr('name'));
	    				});

	    				index++;
	    			});
	    		});

	    		makeSortable();
	    	}

	    	init();
		});

	</script>

@endsection