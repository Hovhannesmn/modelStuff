    <div class="pageheader">
      <h2>
        @if(Auth::user()->hasRole('admin'))
          
          @if(!Request::is('admin*'))

            <a href="/profile" class="page-icon"><i class="fa fa-female"></i></a>
            {{ Languages::trans('admin.navigation.profiles') }}

          @else

            <a href="/admin" class="page-icon"><i class="fa fa-cog"></i></a>
            {{ Languages::trans('admin.navigation.dashboard') }}

          @endif

        @else

          <a href="/profile" class="page-icon"><i class="fa fa-female"></i></a>
          {{ Languages::trans('admin.navigation.profile') }}
        
        @endif

        @yield('page-title')

      </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">{{ Languages::trans('admin.breadcrumbs.you_are_here') }} :</span>
        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i></a></li>
          
          @yield('breadcrumbs')
          
        </ol>
      </div>
    </div>