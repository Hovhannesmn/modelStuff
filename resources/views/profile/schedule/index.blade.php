@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('model.profile.my_schedule') }}</span>
@endsection

@section('breadcrumbs')
	<li class="active">{{ Languages::trans('model.profile.my_schedule') }}</li>
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
      <a href="/{{Auth::user()->roles[0]->name}}/profile/{{ $profile->id }}/schedule/create"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.add_new') }}</a>
    </li>
	</ul>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>{{ Languages::trans('model.profile.dates_range') }}</th>
          <th>{{ Languages::trans('model.profile.working_days') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach( $schedules as $schedule )
          <tr class="schedule-row">
            <td class="td-ckbox">
              <div class="ckbox ckbox-default">
                <input class="checked_item" data-schedule-id="{!! $schedule->id !!}" type="checkbox" name="checked[{!! $schedule->id !!}]" id="checked_{!! $schedule->id !!}" value="1" />
                <label for="checked_{!! $schedule->id !!}"></label>
              </div>
            </td>
            <td>{{ $schedule->date_from }} - {{ $schedule->date_to }}</td>
            <td>
              @foreach($schedule->days as $day)
                <span style="display: inline-block;width: 6em;">{{ $day['names'] }}</span>{{ $day['from'] }} - {{ $day['to'] }}<br>
              @endforeach
            </td>
            <td class="table-action">
              <a href="/{{Auth::user()->roles[0]->name}}/profile/{{ $profile->id }}/schedule/{{ $schedule->id }}/edit"><i class="fa fa-pencil"></i></a>
              <a class="btn-schedule-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
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
          $('.schedule-row input').each(function(){
            $(this).attr('checked',true);
          });
          enable_itemopt(true);
        } 
        else {
          $('.schedule-row input').each(function(){
            $(this).attr('checked',false);
          });
          enable_itemopt(false);
        }
      });
    
      $('#deselectall').click(function(event){
        event.preventDefault();
        $('.schedule-row input').each(function(){
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
          $('.schedule-row input').each(function(){
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
          id.push($(e).attr('data-schedule-id'));
        });

        if(id.length > 0){
          $.ajax({
            method: 'DELETE',
            url: '/profile/{{ $profile->id }}/schedule/' + id.join('-'),
            success: function(response){
                if(response.error){
                  confirm(response.error);
                }
                for(var i = 0; i < response.length; i++){
                  $('#checked_' + response[i]).closest('.schedule-row').remove();
                }
            }
          });
        }

        $('#selectall').removeAttr('checked');
        enable_itemopt(false);
      };

      $('.btn-schedule-remove').click(function(event){
        event.preventDefault();

        var schedule = $(this).closest('.schedule-row');

        if(confirm("{!! Languages::trans('admin.schedules.delete_confirm_single') !!}?")){
          deleteItems(schedule.find('.checked_item'));
        }

      });

      $('#deleteall').click(function(event){
        event.preventDefault();

        var schedule = $(this).closest('.schedule-row');

        if(confirm("{!! Languages::trans('admin.schedules.delete_confirm_multiple') !!}?")){
          deleteItems($('.checked_item:checked'));
        }

      });
    });
  
  </script>
@endsection