<header class="page">
	<div class="container">
		<div class="header-table">
			<div class="header-cell hc-2">
				<div class="logo-name">{{ Languages::fromArrayOrFallback(Contacts::get('name')) }}</div>
			</div>
			<div class="header-cell hc-l">
				<?php $site_logo = Theme::getSetting('site_logo'); ?>
				@if($site_logo)
				<img class="logo-small" src="{!! $site_logo->url !!}" alt="">
				@endif
			</div>
			<div class="header-cell hc-a">
				{{ Languages::fromArrayOrFallback(Contacts::get('address')) }}<br>
				{{Contacts::get('phone') }}<br>
				{{Contacts::get('email') }}
			</div>
		</div>
		<div class="row">
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			      	@foreach(Navigation::area('primary') as $link)
			      	<?php $anchor = Navigation::link($link); ?>
			        <li {!! Request::is(str_replace(Request::root().'/', '', $anchor))?'class="active"':'' !!}><a href="{!! $anchor !!}">{!! Navigation::title($link) !!}</a></li>
			        @endforeach
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{!! Languages::flagUrl(App::getLocale()) !!}" class="flag" alt="">{{ strtoupper(App::getLocale()) }}&nbsp;&nbsp;&nbsp;<span class="caret"></span></a>
			          <ul class="dropdown-menu">
			          	@foreach(Languages::all() as $lang)
			            <li><a href="{!! Languages::localizeUrl($lang) !!}"><img src="{!! Languages::flagUrl($lang) !!}" class="flag" alt="">{{ strtoupper($lang) }}</a></li>
						@endforeach
			          </ul>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
	</div>
</header>