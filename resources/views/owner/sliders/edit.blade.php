@extends('admin')

@section('page-title')
	<span>Sliders</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">Sliders</li>
@endsection

@section('content')
  
  {!! Form::open(['method'=>'PUT', 'route'=>['admin.sliders.update', $slider->id], 'class'=>'form-horizontal']) !!}
	<div class="row">
   <div class="col-sm-4 pull-right-sm">
     <div class="panel panel-default">
       <div class="panel-body">
         <label for="">Slider title:</label>
         {!! Form::text('title', $slider->title , ['class'=>'form-control']) !!}
       </div>
       <div class="panel-footer">
         {!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}
       </div>
     </div>
   </div>
   <div class="col-sm-8">
      <div class="mb15">
        <a href="/admin/sliders" class="btn btn-xs btn-white">Back</a>&nbsp;&nbsp;&nbsp;
        <a href="#" class="btn btn-xs btn-success is-on">+ Add slide</a>
      </div>
     <div id="render">

     </div>
   </div>

  </div>
  {!! Form::close() !!}

@endsection

@section('footer-scripts')
  @include('partial.imageselect')
  <script type="text/javascript" src="{!! url('assets/admin/js/jsviews.min.js') !!}"></script>
  <script type="text/javascript" src="{!! url('assets/admin/js/jsviews.jui.js') !!}"></script>
  <script id="list-tpl" type="text/x-jsrender">
    <div class="panel panel-default panel-alt item">
      <div class="row panel-body">
        <div class="col-xs-4 img">
          <img src="[[:url]]" style="max-width: 100%;">
          <input type="hidden" name="s[][url]" value="[[:url]]">
        </div>
        <div class="col-xs-8">
          <label>Title:</label>
          <input data-link="title trigger=true" type="text" name="s[][title]" value="[[:title]]" class="form-control mb15">
          <label>Content:</label>
          <textarea data-link="content trigger=true" name="s[][content]" rows="3" class="form-control">[[:content]]</textarea>
        </div>
      </div>
      <a href="#" class="text-muted remove">×</a>
    </div>
  </script>
  <style>
    @media (min-width: 768px) {
      .pull-right-sm {
        float: right;
      }
    }
    .item{
      position: relative;
    }
    .remove{
      position: absolute;
      right: 10px;
      top: 7px;
    }
  </style>
  <script type="text/javascript">
    var slides;
    var cbIsDone;
    jQuery(document).ready(function($){
      slides = $.parseJSON('{!! $slider->getOriginal('content'); !!}');
      if(!slides)
      {
        slides = [];
      }

      $.views.settings.delimiters("[[","]]");
      var template = $.templates("#list-tpl");
      template.link("#render", slides);
      $('#render').sortable({});

      cbIsDone = function()
      {
        $('.image-select .image.selected').each(function(){
          var url = $(this).attr('data-url');
          if(url != '')
          {
            $.observable(slides).insert({
              url: url,
              title: '',
              content: ''
            });
          }
        });
      }

      $(document).on('click', '.item .remove', function(e){
        e.preventDefault();
        $(this).closest('.item').remove();
      });

      $('form').submit(function(e){
        var index = 0;
        $('.item').each(function(i, e){
          $(e).find('input, textarea').each(function(){
            $(this).attr('name', $(this).attr('name').replace('s[]', 'content['+index+']'));
          });
          index++;
        });
      });

    });
  
  </script>
@endsection