@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('general.labels.translate') }} "{{ $original->title }}"</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/pages">{{ Languages::trans('admin.navigation.pages') }}</a></li>
	<li class="active">{{ Languages::trans('general.labels.translate') }}</li>
@endsection

@section('content')
	
	@include('admin.partial.errors')

	{!! Form::open(['method'=>'POST', 'url'=>url('/admin/pages/'.$original->id.'/translate/'.$lang), 'class'=>'form-horizontal']) !!}
		
		<?php 
			$title = 'Translation for ['.$lang.']<br><i style="color: #888; font-size: 12px;">Original: <a href="/admin/pages/'.$original->id.'/edit">'.$original->title.'</a></i>';
			$type = 'translate';
			$submit = Languages::trans('general.buttons.save');
		 ?>

		@include('admin.page.render')

	{!! Form::close() !!}
	@include('partial.imageselect')
@endsection

@section('footer-scripts')
	@include('admin.page.scripts');
@endsection