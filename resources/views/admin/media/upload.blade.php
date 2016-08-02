@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.media') }} {{ Languages::trans('admin.breadcrumbs.upload') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/media">{{ Languages::trans('admin.navigation.media') }}</a></li>
	<li class="active">{{ Languages::trans('admin.breadcrumbs.upload') }}</li>
@endsection

@section('content')
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="/admin/media" class="btn btn-primary pull-right">Done</a>
			<h4 class="panel-title">Multi-File Upload</h4>
			<p>Files automatically added to root uploads directory</p>
		</div>
		<div class="panel-body">

			{!! Form::open(['method'=>'POST', 'route'=>'admin.media.store', 'class'=>'dropzone', 'files'=>true]) !!}
			
				<div class="fallback">
					{!! Form::file('file', ['multiple'=>'true']) !!}
				<div>

			{!! Form::close() !!}

		</div>
	</div>

@endsection