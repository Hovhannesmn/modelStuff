@extends('admin')

@section('page-title')
	<span>Galleries</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">Galleries</li>
@endsection

@section('content')
  
  {!! Form::open(['method'=>'PUT', 'route'=>['admin.galleries.update', $gallery->id], 'class'=>'form-horizontal']) !!}
	<div class="row">
   <div class="col-sm-4 pull-right-sm">
     <div class="panel panel-default">
       <div class="panel-body">
         <label for="">Gallery title:</label>
         {!! Form::text('title', $gallery->title , ['class'=>'form-control']) !!}
       </div>
       <div class="panel-footer">
         {!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}
       </div>
     </div>
   </div>
   <div class="col-sm-8">
      <div class="mb15">
        <a href="/admin/sliders" class="btn btn-xs btn-white">Back</a>&nbsp;&nbsp;&nbsp;
        <a href="#" class="btn btn-xs btn-success is-on">+ Add image</a>
      </div>
     <div class="row" id="render">

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
    <div class="col-sm-6">
      <div class="image-wrap">
      <div class="image" style="background-image: url('[[:url]]')">
      <input type="hidden" name="s[][url]" value="[[:url]]">
      <a href="#" class="text-muted remove">×</a>
      </div>
      </div>
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
    .image-wrap{
     background-color: #fff;
     padding: 30px 15px 15px 15px;
     margin-bottom: 15px;
     border: 1px dotted #bbb;
     border-radius: 5px;
     position: relative;
    }
    #render .image{
     background-size: contain;
     background-position: center;
     background-repeat: no-repeat;
     height: 150px;
    }

  </style>
  <script type="text/javascript">
    var slides;
    var cbIsDone;
    jQuery(document).ready(function($){
      slides = $.parseJSON('{!! $gallery->getOriginal('content'); !!}');
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
        $('.image').each(function(i, e){
          $(e).find('input, textarea').each(function(){
            $(this).attr('name', $(this).attr('name').replace('s[]', 'content['+index+']'));
          });
          index++;
        });
      });

    });
  
  </script>
@endsection