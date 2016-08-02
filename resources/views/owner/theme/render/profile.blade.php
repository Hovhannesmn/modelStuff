
@include('admin.theme.rendertop')

<?php 
	$v = Theme::sValue($option['name']); 

	$profiles = array();
	foreach (App\Profile::all() as $profile) {
		$profiles[$profile->id] = $profile->name;
	}
?>

<div class="to-page col-sm-6">
	<div class="row">
	{!! Form::select($option['name'].'[value]' , $profiles , $v, ['class'=>'form-control to-page-input']) !!}
	</div>
</div>

@include('admin.theme.renderbot')