@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.users') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.users') }}</li>
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
      <a href="{{ route('admin.users.create') }}"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('admin.users.create_user') }}</a>
    </li>
    <li class="filter-type">
      {{ Languages::trans('general.labels.show') }}:
      <a {!! Request::is('admin/users') ? 'class="active"' : '' !!} href="{{ route('admin.users.index') }}">{{ Languages::trans('general.buttons.all') }} ({{ $users->count() }})</a> 
      <a {!! Request::is('admin/users/admin') ? 'class="active"' : '' !!} href="{{ route('admin.users.show', 'admin') }}">{{ Languages::trans('admin.users.administrators') }}</a>
      <a {!! Request::is('admin/users/model') ? 'class="active"' : '' !!} href="{{ route('admin.users.show', 'model') }}">{{ Languages::trans('admin.users.models') }}</a>
    </li>
	</ul>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>{{ Languages::trans('admin.users.name') }}</th>
          <th>{{ Languages::trans('admin.users.email') }}</th>
          <th>{{ Languages::trans('admin.users.role') }}</th>
          <th>{{ Languages::trans('admin.users.profile') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach( $users as $user )
          <tr class="user-row">
            <td class="td-ckbox">
              <div class="ckbox ckbox-default">
                <input class="checked_item" data-user-id="{!! $user->id !!}" type="checkbox" name="checked[{!! $user->id !!}]" id="checked_{!! $user->id !!}" value="1" />
                <label for="checked_{!! $user->id !!}"></label>
              </div>
            </td>
            <td class="user-name">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="user-roles">
              @foreach( $user->roles->sortBy('id') as $role )
                {{ $role->name }} <span class="sep"> / </span>
              @endforeach
            </td>
            <td>
              @if( $user->hasRole('model') )
                @if( !$user->profile )
                  <a href="/admin/users/{{ $user->id }}/newprofile" class="text-success"><i class="fa fa-female"></i> +</a>
                @else
                  <a href="/profile/{{ $user->profile->id }}" class="text-muted"><i class="fa fa-female"></i></a>
                  &nbsp;&nbsp;&nbsp;
                  <a href="/profile/{{ $user->profile->id }}/edit" class="text-muted"><i class="fa fa-cog"></i></a>
                @endif
              @endif
            </td>
            <td class="table-action">
              <a href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-pencil"></i></a>
              <a class="btn-user-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

@section('footer-scripts')
  <style>
    .user-roles .sep:last-of-type{
      display: none;
    }
  </style>
  <script type="text/javascript">
  var abc = null;
    jQuery(document).ready(function($){
      jQuery('.ckbox').click(function(){
          enable_itemopt(false);
      });

      $('#selectall').click(function(){
        if($(this).is(':checked')) {
          $('.user-row input').each(function(){
            $(this).attr('checked',true);
          });
          enable_itemopt(true);
        } 
        else {
          $('.user-row input').each(function(){
            $(this).attr('checked',false);
          });
          enable_itemopt(false);
        }
      });
    
      $('#deselectall').click(function(){
        $('.user-row input').each(function(){
          $(this).attr('checked',false);
        });
        enable_itemopt(false);
      });

      
      function enable_itemopt(enable) {
        if(enable) {
          $('#selectall').attr('checked', true);
          $('.itemopt').removeClass('disabled');
        } 
        else {
          var ch = false;
          $('.user-row input').each(function(){
            if($(this).attr('checked'))
              ch = true;
          });

          if(!ch){
            $('#selectall').attr('checked', false);
            $('.itemopt').addClass('disabled');
          }
          else{
            $('.itemopt').removeClass('disabled');
          }
        }
      };

      var deleteItems = function(checked){
        var id = new Array();

        checked.each(function(i, e){
          id.push($(e).attr('data-user-id'));
        });

        if(id.length > 0){
          $.ajax({
            method: 'DELETE',
            url: '{!! route("admin.users.index") !!}/' + id.join('-'),
            success: function(response){
                if(response.error){
                  confirm(response.error);
                }
                for(var i = 0; i < response.length; i++){
                  $('#checked_' + response[i]).closest('.user-row').remove();
                }
            }
          });
        }

        $('#selectall').removeAttr('checked');
        enable_itemopt(false);
      };

      $('.btn-user-remove').click(function(event){
        event.preventDefault();

        var user = $(this).closest('.user-row');

        if(confirm("{!! Languages::trans('admin.users.delete_confirm_single') !!} "+ user.find('.user-name').text() +"?")){
          deleteItems(user.find('.checked_item'));
        }

      });

      $('#deleteall').click(function(event){
        event.preventDefault();

        var user = $(this).closest('.user-row');

        if(confirm("{!! Languages::trans('admin.users.delete_confirm_multiple') !!}?")){
          deleteItems($('.checked_item:checked'));
        }

      });
    });
  
  </script>
@endsection