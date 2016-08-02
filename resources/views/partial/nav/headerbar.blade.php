    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>



      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle signed-user" data-toggle="dropdown">
                <span class="signed-icon"><i class="fa fa-user"></i></span>
                {{ Auth::user()->name }}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                @if(Auth::user()->hasRole('admin'))
                  <li><a href="{!! route('admin.users.edit', Auth::user()->id) !!}"><i class="glyphicon glyphicon-cog"></i> {{ Languages::trans('admin.navigation.account_settings') }}</a></li>
                @else
                  <li><a href="/{{ Auth::user()->roles[0]->name}}/profile"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                @endif
                <li><a href="/signout"><i class="glyphicon glyphicon-log-out"></i> {{ Languages::trans('admin.navigation.log_out') }}</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div><!-- headerbar -->