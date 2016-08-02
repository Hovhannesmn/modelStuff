			</div>

			<?php $bg_image_left = Theme::getSetting('page_background_left'); ?>
			@if($bg_image_left)
			<div class="pagebg-left" style="background-image: url('{!! url($bg_image_left->url) !!}')"></div>
			@endif
			
			<?php $bg_image_right = Theme::getSetting('page_background_right'); ?>
			@if($bg_image_right)
			<div class="pagebg-right" style="background-image: url('{!! url($bg_image_right->url) !!}')"></div>
			@endif

		</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<script type="text/javascript" src="{!! url('assets/t/nicci/js/app.js') !!}"></script>
		<script type="text/javascript" src="{!! url('assets/t/nicci/js/slippry.js') !!}"></script>
		
		<!-- Adding fonts in the end of page load to increase productivity --> 
    	<link href='https://fonts.googleapis.com/css?family=Raleway:300,400,700' rel='stylesheet' type='text/css'>
    	<link rel="stylesheet" href="{!! url('assets/css/font-awesome.min.css') !!}">

		<script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="http://photoswipe.com/dist/photoswipe.css">
		<link rel="stylesheet" type="text/css" href="http://photoswipe.com/dist/default-skin/default-skin.css">

		<script type="text/javascript" src="http://photoswipe.com/dist/photoswipe.min.js"></script>
		<script type="text/javascript" src="http://photoswipe.com/dist/photoswipe-ui-default.min.js"></script>
	</body>
</html>