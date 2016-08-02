@if(Auth::user()->hasRole('admin'))
    <h5 class="sidebartitle">{{ Languages::trans('admin.navigation.website') }}:</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="/admin"><i class="fa fa-tachometer"></i> <span>{{ Languages::trans('admin.navigation.dashboard') }}</span></a></li>

        <li><a href="{!! action('Admin\PagesController@getIndex') !!}"><i class="fa fa-file"></i> <span>{{ Languages::trans('admin.navigation.pages') }}</span></a></li>

        <li {!! Request::is('admin/navigation') ? 'class="active"' : '' !!} ><a href="{!! url('admin/navigation') !!}"><i class="fa fa-external-link"></i> <span>{{ Languages::trans('admin.navigation.navigation') }}</span></a></li>
        <li {!! Request::is('admin/theme') ? 'class="active"' : '' !!}><a href="{!! url('admin/theme') !!}"><i class="fa fa-puzzle-piece"></i> <span>{{ Languages::trans('admin.navigation.theme_options') }}</span></a></li>
        <li class="nav-parent {{ Request::is('admin/media*') || Request::is('admin/sliders*') || Request::is('admin/galleries*') ? 'active nav-active' : '' }}">
            <a href="#"><i class="fa fa-desktop"></i> <span>{{ Languages::trans('admin.navigation.media') }}</span></a>
            <ul class="children" {!! Request::is('admin/media*') || Request::is('admin/sliders*') || Request::is('admin/galleries*') ? 'style="display: block;" ' : '' !!}>
                <li {!! Request::is('admin/media*') ? 'class="active"' : '' !!} ><a href="/admin/media"><i class="fa fa-files-o"></i> {{ Languages::trans('admin.navigation.media_files') }}</a></li>
                <li {!! Request::is('admin/sliders*') ? 'class="active"' : '' !!} ><a href="/admin/sliders"><i class="fa fa-picture-o"></i> {{ Languages::trans('admin.navigation.sliders') }}</a></li>
                <li {!! Request::is('admin/galleries*') ? 'class="active"' : '' !!} ><a href="/admin/galleries"><i class="fa fa-th"></i> {{ Languages::trans('admin.navigation.galleries') }}</a></li>
            </ul>
        </li>

        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="fa fa-user"></i> <span>{{ Languages::trans('admin.navigation.users') }}</span></a></li>

        <li class="nav-parent {{ Request::is('admin/settings*') ? 'active nav-active' : '' }}"><a href="#"><i class="fa fa-cogs"></i> <span>{{ Languages::trans('admin.navigation.settings') }}</span></a>
            <ul class="children" {!! Request::is('admin/settings*') ? 'style="display: block;" ' : '' !!}>
                <li {!! Request::is('admin/settings/general') ? 'class="active"' : '' !!} ><a href="{{ action('Admin\SettingsController@getGeneral') }}"><i class="fa fa-cog"></i> {{ Languages::trans('admin.navigation.general') }}</a></li>
                
                <li {!! Request::is('admin/settings/themes') ? 'class="active"' : '' !!} ><a href="{{ action('Admin\SettingsController@getThemes') }}"><i class="fa fa-eye"></i> {{ Languages::trans('admin.navigation.themes') }}</a></li>

                <li {!! Request::is('admin/settings/languages') ? 'class="active"' : '' !!} ><a href="{{ action('Admin\SettingsController@getLanguages') }}"><i class="fa fa-flag"></i> {{ Languages::trans('admin.navigation.languages') }}</a></li>
                <li {!! Request::is('admin/settings/strings') ? 'class="active"' : '' !!} ><a href="{{ action('Admin\SettingsController@getStrings') }}"><i class="fa fa-language"></i> {{ Languages::trans('admin.navigation.translations') }}</a></li>
                <li {!! Request::is('admin/settings/access') ? 'class="active"' : '' !!} ><a href="{{ action('Admin\SettingsController@getAccess') }}"><i class="fa fa-lock"></i> {{ Languages::trans('admin.navigation.access') }}</a></li>
            </ul>
        </li>
    </ul>

    @if( Settings::get('website_type') == 'c' )
    <h5 class="sidebartitle">{{ Languages::trans('admin.navigation.club') }}</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class=""><a href="/admin/profile/list"><i class="fa fa-female"></i> <span>{{ Languages::trans('admin.navigation.models') }}</span></a></li>
        
        <li class="{{ Request::is('admin/services*') ? 'active' : '' }}"><a href="{{ route('admin.services.index') }}"><i class="fa fa-wrench"></i> <span>{{ Languages::trans('admin.navigation.services') }}</span></a></li>

        <li class="{{ Request::is('admin/contacts') ? 'active' : '' }}"><a href="{{ action('Admin\ContactsController@getIndex') }}"><i class="fa fa-envelope"></i> <span>{{ Languages::trans('admin.navigation.contacts') }}</span></a></li>
    </ul>
    @endif
@endif

