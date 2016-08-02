@include('themes.nicci.partial.header')

	@include('themes.nicci.partial.pageheader')
		
		<?php 
			$template = Theme::template('contacts')->forPage($page);
			$profile = Theme::getSetting('my_profile');
		?>

		<div class="row">
			<div class="col-xs-12 col-sm-6 pull-right">
				
				{!! $page->content['right_side'] !!}

				@if($profile)
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td class="text-primary">My booking email:</td>
								<td>{{ $profile->contact_email }}</td>
							</tr>
							<tr>
								<td class="text-primary">Phone:</td>
								<td>{{ $profile->cellphone }}</td>
							</tr>
						</tbody>
					</table>
				@endif
			</div>
			<div class="col-xs-12 col-sm-6">
				<h1 class="heading-l" style="margin-top: 30px; margin-bottom: 0;">{!! $template->optionValue('contact_form_title') !!}</h1>
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
			<div class="col-sm-12">
				{!! $page->content['map'] !!}	
			</div>
		</div>



	@include('themes.nicci.partial.pagefooter')

@include('themes.nicci.partial.footer')