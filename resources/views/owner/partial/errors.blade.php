@if( $errors->any() )
{{--{{dd(Request::all())}}--}}
	<div class="panel panel-danger">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="#" class="panel-close">×</a>
			</div>
			<h4 class="panel-title">{{ Languages::trans('general.errors.error_occurred') }}</h4>
		</div>
		<div class="panel-body">
			
			@foreach( $errors->all() as $error)

				-  {{trans("validation." . $error )}} <br>

			@endforeach

		</div>
	</div>

@endif