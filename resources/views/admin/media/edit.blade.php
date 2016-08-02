@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.media') }} {{ Languages::trans('admin.breadcrumbs.upload') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/media">{{ Languages::trans('admin.navigation.media') }}</a></li>
	<li class="active">Edit</li>
@endsection

@section('content')
	
	<a href="/admin/media" class="btn btn-xs btn-white"><i class="fa fa-arrow-left"></i> Back</a>
	<div class="mb15"></div>
	<div class="row">
		<div class="col-sm-5">
			<img src="{!! url($image->url) !!}" class="mb15" style="max-width: 100%;">
		</div>
		<div class="col-sm-7">
			{!! Form::open(['method'=>'PUT', 'url'=>url('admin/media/'.$image->id), 'class'=>'form-horizontal']) !!}
			<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Image fields:</h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="control-label col-sm-3">File name</label>
					<div class="col-sm-8">
						{!! Form::text('', $image->file_name, ['class'=>'form-control input-sm', 'disabled' => 'true']) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-sm-3">Title</label>
					<div class="col-sm-8">
						{!! Form::text('title', $image->title, ['class'=>'form-control input-sm']) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-sm-3">Caption</label>
					<div class="col-sm-8">
						{!! Form::textarea('caption', $image->caption, ['class'=>'form-control input-sm', 'rows'=>3]) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-sm-3">Alt</label>
					<div class="col-sm-8">
						{!! Form::textarea('alt', $image->alt, ['class'=>'form-control input-sm', 'rows'=>3]) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-sm-3">Description</label>
					<div class="col-sm-8">
						{!! Form::textarea('description', $image->description, ['class'=>'form-control input-sm', 'rows'=>3]) !!}
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-3">
						{!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}
					</div>
				</div>
			</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>

@endsection