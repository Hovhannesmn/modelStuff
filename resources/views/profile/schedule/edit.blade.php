@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('model.profile.my_schedule') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/profile/{{ $profile_id }}/schedule">{{ Languages::trans('model.profile.my_schedule') }}</a></li>
	<li class="active">{{ Languages::trans('general.buttons.edit') }}</li>
@endsection

@section('content')

	@include('admin.partial.errors')
	
	{!! Form::open(['method'=>'PUT', 'url'=> url('profile/' . $profile_id . '/schedule/' . $schedule->id), 'class'=>'form-horizontal']) !!}

		{!! Form::input('hidden','business_hours', $schedule->getOriginal('days') , ['class'=>'form-control']) !!}

		<div class="panel panel-default">
		
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('model.profile.edit_dates_range') }} :</h4>
			</div>

			<div class="panel-body">

				<div class="row">
					<div class="col-xs-12">
						<div class="date-range" style="max-width: 100%;">
							<div class="row">
								<div class="col-sm-6">
									<label>{{ Languages::trans('model.profile.date_from') }}:</label>
									<div class="input-group mb15">
										{!! Form::text('date_from', $schedule->date_from , ['class'=>'form-control datepicker-from', 'placeholder'=>'dd/mm/yy' ]) !!}
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
								<div class="col-sm-6">
									<label>{{ Languages::trans('model.profile.date_to') }}:</label>
									<div class="input-group mb15">
										{!! Form::text('date_to', $schedule->date_to , ['class'=>'form-control datepicker-to', 'placeholder'=>'dd/mm/yy' ]) !!}
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
						<p>{{ Languages::trans('model.profile.select_days') }}:</p>
						<div id="businessHours"></div>
					</div>
				</div>

			</div>

		</div>

		<div class="panel-footer">

			{!! Form::submit(Languages::trans('general.buttons.save'), ['class'=>'btn btn-primary']) !!}
		
		</div>

	{!! Form::close() !!}

@endsection

@section('footer-scripts')
	<script>
		jQuery(function($){

			var bhPostInit = function(){
				$("#businessHours").find('.operationTimeFrom, .operationTimeTill').each(function(i, e){
					$(e).timepicki({
						show_meridian:false,
						min_hour_value:0,
						max_hour_value:24, 
						step_size_minutes:15, 
						//overflow_minutes:true,
						start_time: $(e).val().split(':')
					});
				});
			};

			var bhPostTpl = '<div class="dayContainer mb20" style="width: 100px;">' +
                        '<div data-original-title="" class="colorBox"><div class="weekday"></div><input type="checkbox" class="invisible operationState"/></div>' +
                        '<div class="operationDayTimeContainer">' +
                        '<div class="operationTime input-group input-group-sm"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="timepicker form-control operationTimeFrom" value=""/></div>' +
                        '<div class="operationTime input-group input-group-sm"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="timepicker form-control operationTimeTill" value=""/></div>' +
                        '</div></div>';

			var businessHoursPrev = {};
			try{
                businessHoursPrev = jQuery.parseJSON($('input[name="business_hours"]').val());
            }
            catch(e){}

            if(businessHoursPrev){
				var businessHours = $("#businessHours").businessHours({
					operationTime: businessHoursPrev,
					postInit: bhPostInit,
					dayTmpl: bhPostTpl
				});
            }else{
            	var businessHours = $("#businessHours").businessHours({
					postInit: bhPostInit,
					dayTmpl: bhPostTpl
				});
            }

			$('.datepicker-from').datepicker({
				dateFormat: "dd/mm/yy",
				firstDay: 1,
				gotoCurrent: true,
				minDate: 0,
				onSelect: function(date, instance){
					$('.datepicker-to').datepicker( "option", "minDate", date );
				}
			});

			$('.datepicker-to').datepicker({
				dateFormat: "dd/mm/yy",
				firstDay: 1,
				gotoCurrent: true,
				minDate: 0,
				onSelect: function(date, instance){
					$('.datepicker-from').datepicker( "option", "maxDate", date );
				}
			});

			$(window).resize(function(){
				var width = 100;
				if($(window).width() < 800){
					var width = 200;
					$('.date-range').width(width);
				}else{
					$('.date-range').width(width * 7 + 8*6);
				}

				$('.dayContainer').each(function(){
					$(this).width(width);
				});


			}).trigger('resize');

			var fromCode = false;
			$('form').submit(function(event){
				if(!fromCode){
					event.preventDefault();

					$('input[name="business_hours"]').val(JSON.stringify(businessHours.serialize()));

					$("#businessHours").remove();

					fromCode = true;
					
					$('form').submit();
				}
			});
		});
	</script>
	<style>
		.timepicker_wrap{
			width: 185px !important;	
		}
		.timepicker_wrap input.timepicki-input{
			height: 35px;
		}
	</style>

	<link rel="stylesheet" type="text/css" href="/jquery.businessHours.css"/>
	<link rel="stylesheet" type="text/css" href="http://senthilraj.github.io/TimePicki/css/timepicki.css">
@endsection