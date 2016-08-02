@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('model.profile.my_services') }}</span>
@endsection

@section('breadcrumbs')
	<li class="active">{{ Languages::trans('model.profile.my_services') }}</li>
@endsection

@section('content')
	
  {!! Form::open(['method'=>'POST', 'url'=> url(Auth::user()->roles[0]->name . '/profile/' . $profile_id . '/services'), 'class'=>'form-horizontal']) !!}

    <div class="panel panel-default">

      <div class="panel-heading">
        <h4 class="panel-title">{{ Languages::trans('model.profile.select_services') }} :</h4>
      </div>

      <div class="panel-body">
        @foreach(\App\Service::all() as $service)

          <div class="form-group">
            <div class="toggle-wrap">
              <div class="toggle toggle-success" data-checkbox-id="toggle_{{ $service->id }}"></div>
              {!! Form::checkbox('service['.$service->id.']', 1 , $profile->hasService($service->id) , ['class'=>'hidden', 'id'=>'toggle_'.$service->id]) !!}
            </div>
            <label class="toggle-label">{{ $service->printName() }}</label>
          </div>

        @endforeach

      </div>

    </div>

    <div class="panel-footer">

      {!! Form::submit(Languages::trans('general.buttons.save'), ['class'=>'btn btn-primary']) !!}
    
    </div>

  {!! Form::close() !!}

@endsection