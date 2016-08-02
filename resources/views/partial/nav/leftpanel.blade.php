  <div class="leftpanel">

    <div class="logopanel">
        @if(Auth::user()->hasRole('model'))

            <h1><span>[</span> Modelle Lüneburg <span>]</span></h1>

        @endif
            @if(Auth::user()->hasRole('owner'))
                <h1><span>[</span> Owner Love house <span>]</span></h1>

            @endif


    </div><!-- logopanel -->
        
    <div class="leftpanelinner">   
        {{--@if(Auth::user()-)--}}
            @if(Auth::user()->hasRole('model'))
                @include('partial.nav.modelstuff')
            @endif
            @if(Auth::user()->hasRole('owner'))
                @include('partial.nav.ownerstuff')
            @endif

    	@include('partial.nav.adminnav')

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->