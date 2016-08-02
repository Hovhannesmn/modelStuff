<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ Theme::pageTitle($page) }}</title>

		<link href="{!! url('assets/t/nicci/css/frontend.css') !!}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]>
			<style type="text/css"> .gradient { filter: none; } </style>
		<![endif]-->
	</head>
	<body>
		<div class="page">
			<div class="container page-inner">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="website-title">{!! Languages::fromArrayOrFallback(Settings::get('website_name')) !!}</div>
						<div class="website-subtitle">{!! Languages::fromArrayOrFallback(Settings::get('website_description')) !!}</div>
					</div>
					
					<?php $my_profile = Theme::getSetting('my_profile'); ?>
					@if($my_profile)
						<div class="col-xs-12 col-sm-6 text-right">
							<div class="general-contacts">
								<span class="text-primary">@</span>&nbsp;&nbsp;&nbsp;{{ $my_profile->contact_email }}<br>
								<span class="text-primary"><i class="fa fa-phone"></i></span>&nbsp;&nbsp;&nbsp;{{ $my_profile->cellphone }}
							</div>
						</div>
					@endif
				</div>
				<div class="row">
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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