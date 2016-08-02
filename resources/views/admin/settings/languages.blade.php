@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.languages') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="/admin/settings">{{ Languages::trans('admin.navigation.settings') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.languages') }}</li>
@endsection

@section('content')

	<div class="panel-lang-list col-xs-12" data-flags-path="{{ 'http://cms.dev/build/assets/admin/flags/4x3/' }}" data-save-url="{!! action('Admin\SettingsController@postLanguages') !!}">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<h4 class="panel-title">
					{{ Languages::trans('admin.settings.languages_list') }}
				</h4>
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table id="lang-sort" class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>{{ Languages::trans('admin.settings.languages_table_name') }}</th>
								<th>{{ Languages::trans('admin.settings.languages_table_code') }}</th>
								<th>{{ Languages::trans('admin.settings.languages_table_flag') }}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach( Languages::all('full') as $lang )
								<tr data-flag="{{ $lang['flag'] }}">
									<td>
										<i class="fa fa-sort"></i> &nbsp;&nbsp;&nbsp;
										<span class="pos-id">{{ $i }}</span>
									</td>
									<td class="data-name">{{ $lang['name'] }}</td>
									<td class="data-code">{{ $lang['code'] }}</td>
									<td class="data-flag">
										<span class="flag-icon flag-icon-{{ $lang['flag'] }}"></span>
									</td>
									<td class="table-action">
										<a class="btn-lang-edit" href="#"><i class="fa fa-pencil"></i></a>
										<a class="btn-lang-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
									</td>
								</tr>
								<?php $i++; ?>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel-footer">
				<button class="btn-save-languages btn btn-primary">
					<i class="fa fa-spinner fa-spin" style="display: none;"></i>
					<span class="lbl">{{ Languages::trans('general.buttons.save_changes') }}</span>
				</button>
				&nbsp;&nbsp;&nbsp;
				<button class="btn-lang-add btn btn-success"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.add_new') }}</button>
			</div>
		</div>
	</div>

	<div class="panel-lang-add col-sm-4">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="panel-btns">
					<a href="#" class="panel-add-close">×</a>
				</div>
				<h4 class="panel-title">
					{{ Languages::trans('admin.settings.create_language') }}
				</h4>
			</div>

			<div class="panel-body">

					<div class="form-group">
						{!! Form::label('newlang_name', Languages::trans('admin.settings.language_name'). ' :', ['class'=>'control-label']) !!}
						{!! Form::text('newlang_name', null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('newlang_code', Languages::trans('admin.settings.language_code'). ' :', ['class'=>'control-label']) !!}
						{!! Form::text('newlang_code', null, ['placeholder'=>'2 Letter ISO code', 'class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('newlang_flag', Languages::trans('admin.settings.language_flag'). ' :', ['class'=>'control-label']) !!}
						{!! Form::select('newlang_flag', Languages::flags(), null, ['class'=>'form-control', 'id'=>'add-lang-dropdown', 'data-live-search'=>'true']) !!}
					</div>

			</div>

			<div class="panel-footer">
				<button class="btn-lang-add-submit btn btn-primary">{{ Languages::trans('general.buttons.create') }}</button>
            </div>
		</div>		
	</div>

	<div class="panel-lang-edit col-sm-4">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<div class="panel-btns">
					<a href="#" class="panel-edit-close">×</a>
				</div>
				<h4 class="panel-title">
					{{ Languages::trans('admin.settings.edit_language') }}
				</h4>
			</div>

			<div class="panel-body">

					<div class="form-group">
						{!! Form::label('editlang_name', Languages::trans('admin.settings.language_name'). ' :', ['class'=>'control-label']) !!}
						{!! Form::text('editlang_name', null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('editlang_code', Languages::trans('admin.settings.language_code'). ' :', ['class'=>'control-label']) !!}
						{!! Form::text('editlang_code', null, ['placeholder'=>'2 Letter ISO code', 'disabled', 'class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('editlang_flag', Languages::trans('admin.settings.language_flag'). ' :', ['class'=>'control-label']) !!}
						{!! Form::select('editlang_flag', Languages::flags(), null, ['class'=>'form-control', 'id'=>'edit-lang-dropdown', 'data-live-search'=>'true']) !!}
					</div>

			</div>

			<div class="panel-footer">
              <button class="btn-lang-edit-submit btn btn-primary">{{ Languages::trans('general.buttons.update') }}</button>
            </div>
		</div>		
	</div>


@endsection