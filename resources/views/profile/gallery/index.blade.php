@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.gallery') }}</span>
@endsection

@section('breadcrumbs')
	<li class="active">{{ Languages::trans('admin.navigation.gallery') }}</li>
@endsection

@section('content')


	<ul class="filemanager-options">
		<li>
			<div class="ckbox ckbox-default" id="selectall">
				<input type="checkbox" name="selectall_ck" value="1" />
				<label >{{ Languages::trans('general.buttons.select_all') }}</label>
			</div>
		</li>
		<li>
			<a id="deselectall" href="#" class="itemopt disabled"><i class="fa fa-times"></i> {{ Languages::trans('general.buttons.deselect_all') }}</a>
		</li>
		<li>
			<a id="deleteall" href="#" class="itemopt disabled"><i class="fa fa-trash-o"></i> {{ Languages::trans('general.buttons.delete') }}</a>
		</li>

		<li class="filter-type">
			<a href="#" class="fileupload-open"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('admin.navigation.upload_images') }}</a>
		</li>
	</ul>

	<div class="row filemanager"></div>
	<div class="row fileupload-panel" style="display: none;">
		<div class="col-xs-12 mb15">
			{!! Form::open(['method'=>'POST', 'url'=>url('profile/'.$profile->id.'/gallery'), 'class'=>'dropzone', 'id'=>'fileupload', 'files'=>true]) !!}
				
				<div class="fallback">
					{!! Form::file('file', ['multiple'=>'true']) !!}
				</div>

			{!! Form::close() !!}
		</div>
		<div class="col-xs-12">
			<a class="btn btn-success fileupload-done">{{ Languages::trans('general.buttons.done') }}</a>
		</div>
	</div>

	@if(intval(Session::get('step')) == 4)
		<a id="finishsteps" class="btn btn-white" href="/{{Auth::user()->roles[0]->name}}/profile/done" {!! $profile->images->count() > 0?'':'style="display:none;' !!}"><i class="fa fa-female"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('model.profile.view_profile') }}</a>
	@endif

@endsection

@section('footer-scripts')
  	<script type="text/javascript" src="{!! url('assets/admin/js/jsviews.min.js') !!}"></script>
  	<script type="text/javascript" src="{!! url('assets/admin/js/jsviews.jui.js') !!}"></script>
	
	<script id="image-tpl" type="text/x-jsrender">
		<div class="col-xs-6 col-sm-4 col-md-3 image">
			<div class="thmb">
				<div class="ckbox ckbox-default" style="display:block;">
					<input class="checked_item" data-item-id="[[:id]]" name="checked_[[:id]]" value="1" type="checkbox">
					<label> </label>
				</div>
				<div class="btn-group fm-group" style="display:block;">
					<button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu fm-menu" role="menu">
						<li><a href="[[:url]]" target="_blank"><i class="fa fa-download"></i> Download</a></li>
						<li><a href="#" class="edit-single"><i class="fa fa-pencil"></i> Edit</a></li>
						<li><a href="#" class="delete-single"><i class="fa fa-trash-o"></i> Delete</a></li>
					</ul>
				</div>
				<div class="thmb-prev" style="background-image: url('[[:url]]');"></div>
			</div>
		</div>
	</script>

    <script type="text/javascript">

    var datam = jQuery.parseJSON('{!! $profile->images->toJson() !!}');
    jQuery(function(){
    	$.views.settings.delimiters("[[","]]");

    	var template = $.templates("#image-tpl");

    	template.link(".filemanager", datam);

		$('.filemanager').sortable({});

		$.observe(datam, function(ev, evarg){
			if(evarg.change == 'move'){
				for(var i = 0; i < datam.length; i++){
					if(datam[i].order != i)
					{
						datam[i].order = i;
						$.ajax({
							'method': 'PUT',


						'url': '{!! url( Auth::user()->roles[0]->name . 'profile/'.$profile->id.'/gallery') !!}/' + datam[i].id,
							'data': datam[i]
						});
					}
				}
			}
		});

		Dropzone.autoDiscover = false;

		var myDropzone = new Dropzone("#fileupload", {

			addRemoveLinks: true,
			dictRemoveFile: 'Remove',
			headers:{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		init:function(data, file) {



			this.on("removedfile", function(event) {

//				event.preventDefault();

					$.ajax({
						method: 'DELETE',
						url: '{!! url('profile/'.$profile->id.'/gallery') !!}/' + 173 ,
						success: function(response){
							if(response.error){
								confirm(response.error);
							}
							for(var i = 0; i < response.length; i++)
							{
								var index = -1;
								for(var j = 0; j < datam.length; j++)
								{
									if(datam[j].id == response[i].id)
									{
										index = j;
										break;
									}
								}
								$.observable(datam).remove(index);
							}


						}
					});




			} );
		},


			success: function(event, response){
//				console.dir(response);
				var sub = response.substr(10);
         		response = JSON.parse(response);

				if(response.id)
				{

					$.observable(datam).insert(response);
					if(myDropzone.getQueuedFiles().length == 0 &&  myDropzone.getUploadingFiles()){
						$('.fileupload-panel').hide(300);
						$('.filemanager').show();
						myDropzone.removeAllFiles();
						if($('#finishsteps').length > 0){
							$('#finishsteps').show();
						}
					}
				}
				else
				{
					$(event.previewTemplate).addClass('dz-success');
				}
			}
        });

		$('.fileupload-open').click(function(event){
			event.preventDefault();
			$('.filemanager').hide();
			$('.fileupload-panel').slideDown(300);
		});
		$('.fileupload-done').click(function(event){
			event.preventDefault();
			$('.fileupload-panel').hide();
			myDropzone.removeAllFiles();
			$('.filemanager').slideDown(300);
		});


		$(document).on('click', '.filemanager .ckbox', function(){
			var inp = $(this).find('input');
			if(inp.attr('checked')){
				inp.attr('checked', false);
			}else{
				inp.attr('checked', true);
			}
			enable_itemopt(false);
		});

		$('#selectall').click(function(event){
			event.preventDefault();

			$('.image').each(function(){
				$(this).find('input').attr('checked',true);
			});

			enable_itemopt(true);
		});

		$('#deselectall').click(function(event){
			event.preventDefault();
			$('.image').each(function(){
				$(this).find('input').attr('checked',false);
				$(this).removeClass('checked');
			});
			enable_itemopt(false);
		});


      function enable_itemopt(enable) {
		if(enable) {
			$('#selectall input').attr('checked', true);
			$('.itemopt').removeClass('disabled');
		}
		else {
			var ch = true;
			$('.image input').each(function(){
				if(!$(this).attr('checked'))
					ch = false;
			});

			if(!ch){
				$('#selectall input').attr('checked', false);
				if($('.image input:checked').length == 0){
					$('.itemopt').addClass('disabled');
				}
				else{
					$('.itemopt').removeClass('disabled');
				}
			}
			else{
				$('#selectall input').attr('checked', true)
				$('.itemopt').removeClass('disabled');
			}
		}
      };

      var deleteItems = function(checked){
        var id = new Array();
        checked.each(function(i, e){
          id.push($(e).attr('data-item-id'));
        });

        if(id.length > 0){
          $.ajax({
            method: 'DELETE',
            url: '{!! url('profile/'.$profile->id.'/gallery') !!}/' + id.join('-'),
            success: function(response){
                if(response.error){
                  confirm(response.error);
                }
                for(var i = 0; i < response.length; i++)
                {
                	var index = -1;
                	for(var j = 0; j < datam.length; j++)
                	{
                		if(datam[j].id == response[i].id)
                		{
                			index = j;
                			break;
                		}
                	}
                	$.observable(datam).remove(index);
                }

				$('#selectall input').attr('checked', false);
                $('.image input:checked').each(function(){
                	$(this).attr('checked', false);
                });
            }
          });
        }
      };

      $(document).on('click', '.filemanager .delete-single', function(event){
        event.preventDefault();

        var item = $(this).closest('.image');
		deleteItems(item.find('.checked_item'));

      });

      $('#deleteall').click(function(event){
        event.preventDefault();

 		deleteItems($('.checked_item:checked'));
      });
    });

	var photo_counter = 0;



	</script>

@endsection