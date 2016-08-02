@extends('profile')

@section('page-title')
	<span>{{ Languages::trans('admin.breadcrumbs.edit_ptofile') }}</span>
@endsection

@section('breadcrumbs')
	<li class="active">{{ Languages::trans('admin.breadcrumbs.edit_ptofile') }}</li>
@endsection

@section('content')


    @include('admin.partial.errors')
    <div class="row">
      <div class="col-sm-3">
          <div id="profile-image-container" <?php echo $profile_image?'':'class="image-upload"'; ?>>
            @if($profile_image)

              <img src="{!! $profile_image->url !!}" data-img-id="{!! $profile_image->id !!}" class="thumbnail img-responsive" id="profile-image" alt="" />
              
            @endif
            <div id="upload-container" class="mb15">
              {!! Form::open(['method'=>'POST', 'url'=>url('profile/'.$profile->id.'/gallery'), 'class'=>'dropzone', 'id'=>'uploadImage']) !!}
                <input type="hidden" name="general" value="true">
                <div class="fallback">
                  <input name="file" type="file" />
                </div>
              {!! Form::close() !!}
            </div>
            <div class="clearfix">
              <div class="btn-group pull-right">
                <a href="#" class="btn-pic-change btn btn-xs btn-white"><i class="fa fa-refresh"></i></a>
                <a href="#" class="btn-pic-remove btn btn-xs btn-white"><i class="fa fa-times"></i></a>
                <a href="#" class="btn-pic-back btn btn-xs btn-white"><i class="fa fa-arrow-left"></i></a>
              </div>
            </div>
          </div>
      </div>
      {!! Form::open(['method'=>'POST', 'url'=>url( Auth::user()->roles[0]->name .'/profile/'.$profile->id.'/lovehouse/update'), 'class'=>'form-horizontal']) !!}
        <div class="col-sm-9">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">{{ Languages::trans('model.profile.profile_info') }}:</h4>
            </div>
            <div class="panel-body">
                {!! Form::label('name', Languages::trans('owner.profile.lovehouse_name').':') !!}
                {!! Form::text('lovehosue_name', Auth::user()->lovehouse->name, ['class'=>'form-control']) !!}
                <div class="mb30"></div>
                <div class="mb15"></div>
                {!! Form::label('contact_email', Languages::trans('model.profile.contact_email').':') !!}
                {!! Form::text('contact_email', $profile->contact_email, ['class'=>'form-control']) !!}
                <div class="mb15"></div>
                {!! Form::label('cellphone', Languages::trans('model.profile.contact_phone').':') !!}
                {!! Form::text('cellphone', $profile->cellphone, ['class'=>'form-control']) !!}
              <div class="mb15"></div>

              {!! Form::label('lovehouse.location', Languages::trans('owner.profile.location').':') !!}
              {!! Form::text('owner.profile.location', $profile->contact_email, ['class'=>'form-control']) !!}
                <div class="mb30"></div>
                <div class="langarea" data-locale="{{ Languages::locale() }}">
                  <div class="lapanel clearfix">
                    <label class="pull-left" style="line-height: 30px;">{{ Languages::trans('owner.profile.description') }} (full):</label>
                    <div class="btn-group pull-right">
                        @foreach(Languages::all() as $lang)
                          <a class="btn btn-xs btn-white" href="#" data-lang="{{ $lang }}">{{ $lang }}</a>
                        @endforeach
                    </div>
                  </div> 
                  <div class="editor"></div>             
                  @foreach(Languages::all() as $lang)

                    {!! Form::input('hidden', 'about_full['.$lang.']', Languages::fromArrayOrNull($profile->about_full, $lang), ['class'=>'form-control wysiwyg '.$lang, 'data-lang'=>$lang, 'rows'=>5]) !!}

                  @endforeach
                </div>
            </div>
          </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3">

              {{--<div class="form-group mb30">--}}
                {{--{!! Form::label('languages', Languages::trans('model.profile.languages').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                {{--<div class="col-sm-6" style="text-transform: capitalize;">--}}
                  {{--{!! Form::select('languages[]', $profile->availableLanguages(), $profile->languages, ['class'=>'form-control chosen-select', 'multiple'=>'true']) !!}--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="form-group mb30">--}}
                {{--{!! Form::label('haircolor', Languages::trans('model.profile.haircolor').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                {{--<div class="col-sm-6">--}}
                  {{--{!! Form::select('haircolor', $profile->availableHaircolors(), $profile->haircolor, ['class'=>'form-control']) !!}--}}
                {{--</div>--}}
              {{--</div>--}}
                {{--<div class="form-group mb15">--}}
                  {{--{!! Form::label('age', Languages::trans('model.profile.age').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                  {{--<div class="col-sm-6">--}}
                    {{--{!! Form::input('number', 'age', $profile->age, ['class'=>'form-control', 'min'=>18, 'max'=>80]) !!}--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group mb15">--}}
                  {{--{!! Form::label('weight', Languages::trans('model.profile.weight').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                  {{--<div class="col-sm-6">--}}
                    {{--{!! Form::input('number', 'weight', $profile->weight, ['class'=>'form-control', 'min'=>30, 'max'=>120]) !!}--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group mb15">--}}
                  {{--{!! Form::label('height', Languages::trans('model.profile.height').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                  {{--<div class="col-sm-6">--}}
                    {{--{!! Form::input('number', 'height', $profile->height, ['class'=>'form-control', 'min'=>120, 'max'=>220]) !!}--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<div class="form-group mb30">--}}
                  {{--{!! Form::label('breast', Languages::trans('model.profile.breast').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                  {{--<div class="col-sm-4">--}}
                    {{--{!! Form::select('breast_number', $profile->availableBNumber(), $profile->breast_number, ['class'=>'form-control']) !!}--}}
                  {{--</div>--}}
                  {{--<div class="col-sm-2">--}}
                    {{--{!! Form::select('breast_letter', $profile->availableBLetter(), $profile->breast_letter, ['class'=>'form-control']) !!}--}}
                  {{--</div>--}}
                {{--</div>--}}
              {{--<div class="form-group mb15">--}}
                {{--<label class="col-sm-3 control-label">{{ Languages::trans('model.profile.smoke') }}</label>--}}
                {{--<div class="toggle-wrap" style="padding-top: 5px;">--}}
                  {{--<div class="toggle toggle-success" data-checkbox-id="smoke"></div>--}}
                  {{--{!! Form::checkbox('smoke', 1 , $profile->getOriginal('smoke') , ['class'=>'hidden', 'id'=>'smoke']) !!}--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="form-group mb30">--}}
                {{--<label class="col-sm-3 control-label">{{ Languages::trans('model.profile.drink') }}</label>--}}
                {{--<div class="toggle-wrap" style="padding-top: 5px;">--}}
                  {{--<div class="toggle toggle-success" data-checkbox-id="drink"></div>--}}
                  {{--{!! Form::checkbox('drink', 1 , $profile->getOriginal('drink') , ['class'=>'hidden', 'id'=>'drink']) !!}--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="form-group mb30">--}}
                {{--{!! Form::label('intimicy', Languages::trans('model.profile.intimicy').':', ['class'=>'col-sm-3 control-label']) !!}--}}
                {{--<div class="col-sm-6">--}}
                  {{--{!! Form::select('intimicy', $profile->availableIntimicy(), $profile->intimicy, ['class'=>'form-control']) !!}--}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div> --}}
          <div class="panel-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">

                {!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}

              </div>
            </div>
          </div>       
        </div>
      {!! Form::close() !!}
    </div>


@endsection

@section('footer-scripts')
<style>
  .langarea textarea{
    display: none;
  }
  .lapanel .btn-group{
    text-transform: uppercase;
  } 
  .langarea .editor{
    border: 1px solid #ddd;
    border-radius: 3px;
    height: 130px;
    overflow-x: hidden;
    overflow-y: auto;
  } 

  #profile-image-container.image-upload #profile-image{
    display: none;
  }
  #profile-image-container.image-upload .btn-pic-change{
    display: none;
  }
  #profile-image-container.image-upload .btn-pic-remove{
    display: none;
  }
  #profile-image-container .btn-pic-back{
    display: none;
  }

  #profile-image-container #upload-container{
    display: none;
  }
  #profile-image-container.image-upload #upload-container{
    display: block;
  }

  #profile-image-container #upload-container .dz-message{
    text-align: center;
    width: 100%;
    height: 100%;
    background: transparent;
    margin: 0;
    top: 0;
    left: 0;
    padding-top: 145px;
  }
  #profile-image-container #upload-container .dz-message .fa{
    font-size: 35px;
  }

  #uploadImage{
    border: 3px dashed #bbb;
    height: 360px;
  }

</style>
{{--<script src="{!! url('assets/vendor/quill/quill.js') !!}"></script>--}}
<script src="http://sexyeuropa.com/assets/vendor/quill/quill.js"></script>
<script type="text/javascript">

  Dropzone.autoDiscover = false;

  jQuery(function($){
    $('.langarea').each(function(i, e){
      var editor = new Quill($(e).find('.editor').get(0));
      var current = $(e).attr('data-locale');
      $(e).find('.lapanel .btn[data-lang="'+current+'"]').removeClass('btn-white').addClass('btn-primary');
      editor.setHTML($(e).find('input[data-lang="'+current+'"]').val());

      var container = $(e);
      editor.on('text-change', function(delta, source) {
        container.find('input[data-lang="'+current+'"]').val(editor.getHTML());
      });

      $(e).find('.lapanel .btn').click(function(event){
        event.preventDefault();
        var area = $(this).closest('.langarea');
        area.find('input[data-lang="'+current+'"]').val(editor.getHTML());
        current = $(this).attr('data-lang');
        editor.setHTML(area.find('input[data-lang="'+current+'"]').val());
        area.find('.lapanel .btn').removeClass('btn-primary').addClass('btn-white');
        $(this).removeClass('btn-white').addClass('btn-primary');
      });
    });

    $(".chosen-select").chosen({'width':'100%','white-space':'nowrap'}).change(function(){
      $(this).trigger('chosen:updated');
    });

    jQuery('.toggle').each(function(i, e){
      $(e).toggles({
        text: {on:'Yes', off:'No'},
        checkbox: $('#' + $(e).attr('data-checkbox-id')),
        on: $('#' + $(e).attr('data-checkbox-id')).is(':checked')
      });
    });

    $(document).on('change', '#upload-image', function(){
      console.log(this);
    });

    var myDropzone = new Dropzone("#uploadImage", {
      uploadMultiple: false,
      maxFiles: 1,
      acceptedFiles: 'image/*',
      success: function(event, response){
        response = JSON.parse(response);
        if(response.id)
        {
          $('#profile-image-container').removeClass('image-upload');
          if($('#profile-image').length > 0)
          {
            $('#profile-image').attr('src', response.url);
            $('#profile-image').attr('data-img-id', response.id);
          }
          else
          {
            $('#profile-image-container').prepend('<img src="'+response.url+'" data-img-id="'+response.id+'" class="thumbnail img-responsive" id="profile-image" alt="" />');
          }
          if($('#model-profile-img').length > 0)
          {
            $('#model-profile-img').css('background-image', 'url("'+response.url+'")');
          }
        }
        myDropzone.removeAllFiles(true);
        $('.btn-pic-back').hide();
      }
    });

    $('.dz-message').html('<i class="fa fa-cloud-upload"></i><br>Click to upload');

    $('.btn-pic-change').click(function(){
      $('#profile-image-container').addClass('image-upload');
      $('.btn-pic-back').show();
    });

    $('.btn-pic-back').click(function(){
      $(this).hide();
      $('#profile-image-container').removeClass('image-upload');
    });

    $('.btn-pic-remove').click(function(){
      $.ajax({
        method: 'DELETE',
        url: 'http://sexyeuropa.com/profile/25/gallery/' + $('#profile-image').attr('data-img-id'),
        success: function(response){
          if(response.error){
            confirm(response.error);
          }
          else
          {
            $('#profile-image').remove();
            $('#profile-image-container').addClass('image-upload');
            $('#model-profile').hide();
          }
        }
      });
    });
  });
</script>

<!-- Adding fonts in the end of page load to increase productivity -->
<link rel="stylesheet" href="http://sexyeuropa.com/assets/css/font-awesome.min.css">

@endsection 