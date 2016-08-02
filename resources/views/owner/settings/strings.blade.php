@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.translations') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/settings">{{ Languages::trans('admin.navigation.settings') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.translations') }}</li>
@endsection

@section('content')

	{!! Form::open(['method'=>'POST', 'action'=>'Admin\SettingsController@postStrings', 'class'=>'form-horizontal']) !!}
		
		@include('admin.partial.errors')

		<div class="settings-strings col-sm-8">

			<?php $iterator = 0; ?>
			@foreach(Languages::strings() as $category => $subcategory)
				@foreach($subcategory as $slug => $strings)

					<?php $active = $iterator++ > 0?'style="display: none;"':''; ?>

					<div class="panel panel-default" data-panel="{!! $category.'_'.$slug !!}" {!! $active !!}>

						<div class="panel-heading">
							<h4 class="panel-title">
								<strong>{{ ucfirst($category) }}</strong> > <i>{{ ucfirst($slug) }}</i>
							</h4>
						</div>

						<div class="panel-body">
							@foreach($strings as $strSlug => $strDefault)

								<?php $name = $category.'.'.$slug.'.'.$strSlug; ?>

								<div class="form-group">
									{!! Form::label($strSlug, ucfirst(str_replace('_', ' ', $strSlug)) , ['class'=>'col-sm-3 control-label']) !!}
									<div class="col-sm-9">
										<div class="input-group mb15">
											<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
											{!! Form::text($name.'['.Languages::general().']', Languages::trans($name, Languages::general()), ['class'=>'form-control']) !!}
											<span class="input-group-addon translations-toogle"><i class="fa fa-flag"></i></span>
										</div>
									</div>
									<div class="col-sm-9 col-sm-offset-3 translations">
										<div class="panel panel-default-alt">
											<div class="panel-heading">
												<h6 class="pane-title">Edit translations</h6>
											</div>
											<div class="panel-body">
												@foreach(Languages::allButGeneral() as $lang)

												<div class="input-group input-group-sm mb15">
													<span class="input-group-addon">{{ strtoupper($lang) }} :</span>
													{!! Form::text($name.'['.$lang.']', Languages::trans($name, $lang), ['class'=>'form-control']) !!}
												</div>

												@endforeach
											</div>
										</div>
									</div>
								</div>

							@endforeach
						</div>
					</div>

				@endforeach
			@endforeach

		</div>

		<div class="col-sm-4">
			<div class="panel panel-default">
				
				<div class="panel-heading">
					<h4 class="panel-title">
						Categories
					</h4>
				</div>

				<div class="panel-body">

					<?php $iterator = 0; ?>

					@foreach(Languages::strings() as $category => $links)
					
						<h5><strong>{{ ucfirst($category) }}</strong></h5>

						@foreach($links as $slug => $link)

							<?php $class = $iterator++ > 0?'':'text-success'; ?>

							<a class="btn-show {!! $class !!}" href="#" data-target="{!! $category.'_'.$slug !!}"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;&nbsp;{{ ucfirst($slug) }}</a> <br>

						@endforeach

					@endforeach

				</div>

				<div class="panel-footer">

					{!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}

				</div>
			</div>		
		</div>

	{!! Form::close() !!}

@endsection