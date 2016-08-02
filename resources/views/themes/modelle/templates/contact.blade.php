<?php 
	$template = Theme::template('contacts')->forPage($page);
?>

@include('themes.modelle.partial.header')

<section class="page">
	
	@include('themes.modelle.partial.pageheader')

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 pull-right">

				<h2 class="header profile-header">{!! $template->optionValue('getintouch_title') !!}</h2>

				<p>
					{!! $page->content['getintouch'] !!}
				</p>

				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h2 class="header profile-header">{!! $template->optionValue('contactinfo_title') !!}</h2>
						<p>
							<i class="fa fa-home text-primary" style="width: 20px;"></i> {!! Languages::fromArrayOrNull(Contacts::get('address')) !!}
							<br>
							<i class="fa fa-phone text-primary" style="width: 20px;"></i> {!! Contacts::get('phone') !!}
							<br>
							<i class="fa fa-envelope text-primary" style="width: 20px;"></i> {!! Contacts::get('email') !!}
							<br>
						</p>
					</div>
					<div class="col-xs-12 col-sm-6">
						<h2 class="header profile-header">{!! $template->optionValue('openinghours_title') !!}</h2>
						<p>
							{!! $page->content['openinghours'] !!}
						</p>
					</div>
				</div>

			</div>
			<div class="col-xs-12 col-sm-6">
				<h1 class="header profile-header">{!! $template->optionValue('contact_form_title') !!}</h1>
				{!! Form::open(['method'=>'POST', 'url'=>url('/process-email'), 'class'=>'contact-form form-horizontal']) !!}
					
					{!! Form::input('hidden', 'return', Request::fullUrl()) !!}
					
					<div class="input-group" style="margin-bottom: 15px;">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'* Enter your name', 'required'=>true]) !!}
					</div>

					<div class="input-group" style="margin-bottom: 15px;">
						<span class="input-group-addon">@</span>
						{!! Form::input('email', 'email', null, ['class'=>'form-control', 'placeholder'=>'* Enter your email', 'required'=>true]) !!}
					</div>

					<div class="input-group" style="margin-bottom: 15px;">
						<span class="input-group-addon"><i class="fa fa-phone"></i></span>
						{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter your phone']) !!}
					</div>

					{!! Form::textarea('name', null, ['class'=>'form-control', 'placeholder'=>'* Your message ... ', 'rows'=>4, 'required'=>true]) !!}
					<br>
					{!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}
				{!! Form::close() !!}
			</div>
		</div>
		<div class="row">
			<div style="padding-bottom: 15px;"></div>
			{!! $page->content['map'] !!}	
		</div>
	</div>

	@include('themes.modelle.partial.pagefooter')

</section>

@include('themes.modelle.partial.footer')