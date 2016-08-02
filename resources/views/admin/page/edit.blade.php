@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.pages.edit_page') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/pages">{{ Languages::trans('admin.navigation.pages') }}</a></li>
	<li class="active">{{ Languages::trans('admin.pages.edit_page') }}</li>
@endsection

@section('content')
	
	@include('admin.partial.errors')

	{!! Form::open(['method'=>'POST', 'url'=>url('/admin/pages/'.$page->id.'/save'), 'class'=>'form-horizontal']) !!}
		
		<?php 
			$title = Languages::trans('admin.pages.edit_page');
			$lang = null;
			$type = 'edit';
			$submit = Languages::trans('general.buttons.save');
		 ?>

		@include('admin.page.render')

	{!! Form::close() !!}
	@include('partial.imageselect')
@endsection

@section('footer-scripts')
	@include('admin.page.scripts')
@endsection