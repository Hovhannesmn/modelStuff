  <div class="image-select" style="display: none;">
    <div class="image-select-inner">
      <div class="panel panel-default panel-alt">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="is-off">×</a>
          </div>
          <h3 class="panel-title">Select image:</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            @foreach(App\Media::orderBy('created_at', 'desc')->get() as $image)
            <div class="col-xs-4">
              <div class="image" style="background-image: url('{!! $image->url !!}')" data-url="{!! $image->url !!}" data-id="{!! $image->id !!}"></div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="panel-footer">
          <a href="#" class="btn btn-white btn-xs is-done">Done</a>
        </div>
      </div>
    </div> 
  </div>