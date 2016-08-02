@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.pages.create_page') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/pages">{{ Languages::trans('admin.navigation.pages') }}</a></li>
	<li class="active">{{ Languages::trans('admin.pages.create_page') }}</li>
@endsection

@section('content')
	
	@include('admin.partial.errors')

	{!! Form::open(['method'=>'POST', 'url'=>action('Admin\PagesController@postCreate'), 'class'=>'form-horizontal']) !!}
		
		<?php 
			$title = Languages::trans('admin.pages.create_page'); 
			$lang = null;
			$type = 'create';
			$submit = Languages::trans('general.buttons.add');
		?>
		@include('admin.page.render')

	{!! Form::close() !!}
	@include('partial.imageselect')
@endsection

@section('footer-scripts')
	@include('admin.page.scripts')
@endsection