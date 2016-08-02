@extends('admin')

@section('page-title')
	<span>Sliders</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">Sliders</li>
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
	      <a href="{{ route('admin.sliders.create') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.add') }}</a>
	    </li>
	</ul>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach( $sliders as $slider )
          <tr class="slider-row">
            <td class="td-ckbox">
              <div class="ckbox ckbox-default">
                <input class="checked_item" data-slider-id="{!! $slider->id !!}" type="checkbox" name="checked[{!! $slider->id !!}]" id="checked_{!! $slider->id !!}" value="1" />
                <label for="checked_{!! $slider->id !!}"></label>
              </div>
            </td>
            <td>{{ $slider->title }}</td>
            <td></td>
            <td class="table-action">
              <a href="{{ route('admin.sliders.edit', $slider->id) }}"><i class="fa fa-pencil"></i></a>
              <a class="btn-slider-remove" href="#"><i class="fa fa fa-trash-o"></i></a>
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
          $('.slider-row input').each(function(){
            $(this).attr('checked',true);
          });
          enable_itemopt(true);
        } 
        else {
          $('.slider-row input').each(function(){
            $(this).attr('checked',false);
          });
          enable_itemopt(false);
        }
      });
    
      $('#deselectall').click(function(){
        $('.slider-row input').each(function(){
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
          $('.slider-row input').each(function(){
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
          id.push($(e).attr('data-slider-id'));
        });

        if(id.length > 0){
          $.ajax({
            method: 'DELETE',
            url: '{!! route("admin.sliders.index") !!}/' + id.join('-'),
            success: function(response){
                if(response.error){
                  confirm(response.error);
                }
                for(var i = 0; i < response.length; i++){
                  $('#checked_' + response[i]).closest('.slider-row').remove();
                }
            }
          });
        }

        $('#selectall').removeAttr('checked');
        enable_itemopt(false);
      };

      $('.btn-slider-remove').click(function(event){
        event.preventDefault();

        var slider = $(this).closest('.slider-row');
		deleteItems(slider.find('.checked_item'));

      });

      $('#deleteall').click(function(event){
        event.preventDefault();

        var slider = $(this).closest('.slider-row');
		deleteItems($('.checked_item:checked'));

      });
    });
  
  </script>
@endsection