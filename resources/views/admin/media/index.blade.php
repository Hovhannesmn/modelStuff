@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.media') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.media') }}</li>
@endsection

@section('content')
	
	<ul class="filemanager-options">
		<li>
			<div class="ckbox ckbox-default">
				<input type="checkbox" id="selectall" value="1" />
				<label for="selectall">Select All</label>
			</div>
		</li>
		<li>
			<a id="deselectall" href="#" class="itemopt disabled"><i class="fa fa-times"></i> Deselect all</a>
		</li>
		<li>
			<a id="deleteall" href="#" class="itemopt disabled"><i class="fa fa-trash-o"></i> Delete</a>
		</li>

		<li class="filter-type">
			<a href="{{ url('admin/media/upload') }}"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload files</a>
		</li>
	</ul>

	<div class="row filemanager" style="overflow: hidden;">

		@foreach($mediaItems as $item)

			<div class="col-xs-6 col-sm-4 col-md-3 image">
				<div class="thmb">
					<div class="ckbox ckbox-default">
						<input class="checked_item" data-item-id="{!! $item->id !!}" type="checkbox" name="checked[{!! $item->id !!}]" id="checked_{!! $item->id !!}" value="1" />
						<label for="checked_{!! $item->id !!}"></label>
					</div>
					<div class="btn-group fm-group">
						<button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu fm-menu" role="menu">
							<li><a href="{{ url($item->url) }}" target="_blank"><i class="fa fa-download"></i> Download</a></li>
							<li><a href="{{ route('admin.media.edit', $item->id) }}"><i class="fa fa-pencil"></i> Edit</a></li>
							<li><a href="#" class="delete-single"><i class="fa fa-trash-o"></i> Delete</a></li>
						</ul>
					</div><!-- btn-group -->
					<div class="thmb-prev" style="background-image: url('{{ url($item->url) }}');">
					</div>
					<div style="padding-top: 5px;"><a href="{!! url('admin/media/'.$item->id.'/edit') !!}" target="_blank">{{ $item->file_name }}</a> <br><span style="font-size: 10px;">{{ $item->file_type }}&nbsp;&nbsp;&nbsp;({{ $item->file_size }})</span></div>
					<small class="text-muted">Added: {{ $item->created_at }}</small>
				</div><!-- thmb -->
			</div><!-- col-xs-6 -->

		@endforeach

	</div>

@endsection

@section('footer-scripts')

	<script type="text/javascript">
		  jQuery(document).ready(function(){
    
    jQuery('.thmb').hover(function(){
      var t = jQuery(this);
      t.find('.ckbox').show();
      t.find('.fm-group').show();
    }, function() {
      var t = jQuery(this);
      if(!t.closest('.thmb').hasClass('checked')) {
        t.find('.ckbox').hide();
        t.find('.fm-group').hide();
      }
    });
    
    jQuery('.ckbox').each(function(){
      var t = jQuery(this);
      var parent = t.parent();
      if(t.find('input').is(':checked')) {
        t.show();
        parent.find('.fm-group').show();
        parent.addClass('checked');
      }
    });
    
    
    jQuery('.ckbox').click(function(){
      var t = jQuery(this);
      if(!t.find('input').is(':checked')) {
        t.closest('.thmb').removeClass('checked');
        enable_itemopt(false);
      } else {
        t.closest('.thmb').addClass('checked');
        enable_itemopt(true);
      }
    });
    
    jQuery('#selectall').click(function(){
      if(jQuery(this).is(':checked')) {
        jQuery('.thmb').each(function(){
          jQuery(this).find('input').attr('checked',true);
          jQuery(this).addClass('checked');
          jQuery(this).find('.ckbox, .fm-group').show();
        });
        enable_itemopt(true);
      } else {
        jQuery('.thmb').each(function(){
          jQuery(this).find('input').attr('checked',false);
          jQuery(this).removeClass('checked');
          jQuery(this).find('.ckbox, .fm-group').hide();
        });
        enable_itemopt(false);
      }
    });
	
	jQuery('#deselectall').click(function(){
		jQuery('.thmb').each(function(){
          jQuery(this).find('input').attr('checked',false);
          jQuery(this).removeClass('checked');
          jQuery(this).find('.ckbox, .fm-group').hide();
        });
        enable_itemopt(false);
	});

    
    function enable_itemopt(enable) {
      if(enable) {
        jQuery('.itemopt').removeClass('disabled');
      } else {
        

        // check all thumbs if no remaining checks
        // before we can disabled the options
        var ch = false;
        jQuery('.thmb').each(function(){
          if(jQuery(this).hasClass('checked'))
            ch = true;
        });
        
        if(!ch)
          jQuery('.itemopt').addClass('disabled');
      }
    }

    var deleteItems = function(checked){
		var id = new Array();

		checked.each(function(i, e){
			id.push($(e).attr('data-item-id'));
		});

		if(id.length > 0){
			$.ajax({
				method: 'DELETE',
				url: '{!! route("admin.media.index") !!}/' + id.join('-'),
				success: function(response){
					if(parseInt(response) > 0){
						checked.each(function(i, e){
							$(this).closest('.image').remove();
						});
					}
				}
			});
		}

		jQuery('#selectall').removeAttr('checked');
		jQuery('.thmb').removeClass('checked');
		enable_itemopt(false);
    };

    $('#deleteall').click(function(event){
    	event.preventDefault();

    	deleteItems($('.checked_item:checked'));
    });

    $('.delete-single').click(function(event){
    	event.preventDefault();

    	deleteItems($(this).closest('.image').find('.checked_item'));
    });
    
  });
  
	</script>

@endsection