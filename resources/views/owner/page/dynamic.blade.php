<?php 
	$template = Theme::template(Request::input('template'))->forPage($page);
?>
<div class="result">

	@include('admin.page.content')
	
	@include('admin.page.options')
	
</div>