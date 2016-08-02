<div class="options">
@foreach($template->optionsSettings() as $optionKey => $option)
	<?php 
		$v = $template->optionValue($optionKey);
	?>
	
	<div class="mb15"></div>
	<label>{{ $option['name'] }}:</label>

	@if($option['type'] == 'image')
		<?php 
			$image = App\Media::find($v);
			$url = '';
			if($image)
				$url = url($image->url);
		?>
		<div class="to-image {{ $v?'has-value':'' }}">
			<img src="{!! $url !!}" style="max-width: 100%; max-height: 150px;" class="to-image-value">
			{!! Form::input('hidden', 'settings['.$optionKey.']' , $v, ['class'=>'to-image-input']) !!}
		    <a href="#" class="to-image-select add">Click to select image</a>    	
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-xs refresh"><i class="fa fa-refresh"></i></button>
				<button type="button" class="btn btn-default btn-xs remove">×</button>
			</div>
		</div>
	@endif

	@if($option['type'] == 'string')
		{!! Form::text('settings['.$optionKey.']' , $v, ['class'=>'form-control']) !!}
	@endif

	@if($option['type'] == 'html')
		{!! Form::textarea('settings['.$optionKey.']' , $v, ['class'=>'form-control', 'rows' => 3]) !!}
	@endif

	@if($option['type'] == 'slider')
		{!! Form::select('settings['.$optionKey.']', $template->getList('slider') , $v, ['class'=>'form-control']) !!}
	@endif

	@if($option['type'] == 'gallery')
		{!! Form::select('settings['.$optionKey.']', $template->getList('gallery') , $v, ['class'=>'form-control']) !!}
	@endif

@endforeach
</div>