<?php 
	$is_optional = false;
	if(array_key_exists('optional', $option))
		$is_optional = $option['optional'] == 'yes';
?>


<div class="theme-option mb15">
	<div class="form-group">
		@if($is_optional)
			<div class="option-toggle clearfix  mb15">
            	<label class="col-sm-3">{{ $option['title'] }}</label>
				<div class="toggle-wrap">
              		<div class="toggle toggle-success" data-checkbox-id="toggle_{{ $option['name'] }}"></div>
             		{!! Form::checkbox($option['name'].'[enabled]', '1' , Theme::sOn($option['name']) , ['id'=>'toggle_'.$option['name'], 'class'=>'option-toggle-cb']) !!}
            	</div>
			</div>
		@endif
		<div class="option-control">
			@if(!$is_optional)
				<div class="col-sm-3">
					{{ $option['title'] }}
				</div>
				<div class="col-sm-9">
			@else
				<div class="col-sm-9 col-sm-offset-3">
			@endif
