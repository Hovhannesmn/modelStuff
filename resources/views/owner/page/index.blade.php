@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.pages') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.pages') }}</li>
@endsection

@section('content')
	<ul class="filemanager-options">
		<li>
			<div class="ckbox ckbox-default">
				<input type="checkbox" id="selectall" value="1" />
				<label for="selectall">{{ Languages::trans('general.buttons.select_all') }}</label>
			</div>
		</li>
		<li>
			<a id="deselectall" href="#" class="itemopt disabled"><i class="fa fa-times"></i> {{ Languages::trans('general.buttons.deselect_all') }}</a>
		</li>
		<li>
			<a id="deleteall" href="#" class="itemopt disabled"><i class="fa fa-trash-o"></i> {{ Languages::trans('general.buttons.delete') }}</a>
		</li>
	    <li class="filter-type">
	      <a href="/admin/pages/create"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.create') }}</a>
	    </li>
	</ul>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>{{ Languages::trans('general.buttons.title') }}</th>
          <th>{{ Languages::trans('general.buttons.slug') }}</th>
          <th>{{ Languages::trans('general.buttons.languages') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach( $pages as $page )
          <tr class="page-row">
            <td class="td-ckbox">
              <div class="ckbox ckbox-default">
                <input class="checked_item" data-page-id="{!! $page->id !!}" type="checkbox" name="checked[{!! $page->id !!}]" id="checked_{!! $page->id !!}" value="1" />
                <label for="checked_{!! $page->id !!}"></label>
              </div>
            </td>
            <td>{{ $page->id }}</td>
            <td>{{ $page->title }}</td>
            <td>{{ $page->title }}</td>
            <td>
            	@foreach(Languages::all() as $lang)
            		@if($page->translatedTo($lang))
            			<a class="text-success" href="pages/{{ $page->id }}/translate/{{ $lang }}">{{ strtoupper($lang) }}</a>&nbsp;&nbsp;&nbsp;
            		@endif
            	@endforeach
            	@foreach(Languages::all() as $lang)
            		@if(!$page->translatedTo($lang))
            			<a class="text-danger" href="pages/{{ $page->id }}/translate/{{ $lang }}">{{ strtoupper($lang) }}</a>&nbsp;&nbsp;&nbsp;
            		@endif
            	@endforeach
            </td>
            <td class="table-action">
              <a href="/admin/pages/{{ $page->id }}/edit"><i class="fa fa-pencil"></i></a>
              <a class="btn-page-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection