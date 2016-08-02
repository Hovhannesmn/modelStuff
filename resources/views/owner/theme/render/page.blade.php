
@include('admin.theme.rendertop')

<?php $v = Theme::sValue($option['name']); ?>

<div class="to-page col-sm-6">
	<div class="row">
	{!! Form::select($option['name'].'[value]' , App\Page::allIdKey() , $v, ['class'=>'form-control to-page-input']) !!}
	</div>
</div>

@include('admin.theme.renderbot')
