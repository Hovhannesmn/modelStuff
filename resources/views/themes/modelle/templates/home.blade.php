@include('themes.modelle.partial.header')

<?php $homepage_background = Theme::getSetting('homepage_background'); ?>
<div class="page-home" style="background-image: url('{!! $homepage_background?$homepage_background->url:'' !!}')">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-2">
				<div class="content">
					<div class="content-inner">
						<?php $site_logo = Theme::getSetting('site_logo'); ?>
						@if($site_logo)
						<img class="home-logo" src="{!! $site_logo->url !!}" alt="">
						@endif
						<h1 class="home-title">Welcome to Modelle Luneburg</h1>
						{!! Theme::template('default')->forPage($page)->content('general') !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@include('themes.modelle.partial.footer')