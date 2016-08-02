@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.services') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.services') }}</li>
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
      <a href="{{ route('admin.services.create') }}"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('admin.services.add_service') }}</a>
    </li>
	</ul>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>{{ Languages::trans('admin.services.slug') }}</th>
          <th>{{ Languages::trans('admin.services.name') }} [{{ Languages::locale() }}] </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach( $services as $service )
          <tr class="service-row">
            <td class="td-ckbox">
              <div class="ckbox ckbox-default">
                <input class="checked_item" data-service-id="{!! $service->id !!}" type="checkbox" name="checked[{!! $service->id !!}]" id="checked_{!! $service->id !!}" value="1" />
                <label for="checked_{!! $service->id !!}"></label>
              </div>
            </td>
            <td class="service-name">{{ $service->slug }}</td>
            <td>{{ $service->printNameIfTrans() }}</td>
            <td class="table-action">
              <a href="{{ route('admin.services.edit', $service->id) }}"><i class="fa fa-pencil"></i></a>
              <a class="btn-service-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

@section('footer-scripts')

  <script type="text/javascript">
    jQuery(document).ready(function($){

      jQuery('.ckbox').click(function(){
          enable_itemopt(false);
      });

      $('#selectall').click(function(){
        if($(this).is(':checked')) {
          $('.service-row input').each(function(){
            $(this).attr('checked',true);
          });
          enable_itemopt(true);
        } 
        else {
          $('.service-row input').each(function(){
            $(this).attr('checked',false);
          });
          enable_itemopt(false);
        }
      });
    
      $('#deselectall').click(function(event){
        event.preventDefault();
        $('.service-row input').each(function(){
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
          $('.service-row input').each(function(){
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
          id.push($(e).attr('data-service-id'));
        });

        if(id.length > 0){
          $.ajax({
            method: 'DELETE',
            url: '{!! route("admin.services.index") !!}/' + id.join('-'),
            success: function(response){
                if(response.error){
                  confirm(response.error);
                }
                for(var i = 0; i < response.length; i++){
                  $('#checked_' + response[i]).closest('.service-row').remove();
                }
            }
          });
        }

        $('#selectall').removeAttr('checked');
        enable_itemopt(false);
      };

      $('.btn-service-remove').click(function(event){
        event.preventDefault();

        var service = $(this).closest('.service-row');

        if(confirm("{!! Languages::trans('admin.services.delete_confirm_single') !!} "+ service.find('.service-name').text() +"?")){
          deleteItems(service.find('.checked_item'));
        }

      });

      $('#deleteall').click(function(event){
        event.preventDefault();

        var service = $(this).closest('.service-row');

        if(confirm("{!! Languages::trans('admin.services.delete_confirm_multiple') !!}?")){
          deleteItems($('.checked_item:checked'));
        }

      });
    });
  
  </script>
@endsection