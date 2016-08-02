
@include('admin.theme.rendertop')

<?php 
	$v = Theme::sValue($option['name']); 
	$image = App\Media::find($v);
	$url = '';
	if($image)
		$url = url($image->url);
?>

<div class="to-image {{ $v?'has-value':'' }}">
	<img src="{!! $url !!}" style="max-width: 100%; max-height: 150px;" class="to-image-value">
	{!! Form::input('hidden', $option['name'].'[value]' , $v, ['class'=>'to-image-input']) !!}
    <a href="#" class="to-image-select add">Click to select image</a>    	
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-xs refresh"><i class="fa fa-refresh"></i></button>
		<button type="button" class="btn btn-default btn-xs remove">×</button>
	</div>
</div>

@include('admin.theme.renderbot')
