	<?php 
		$disabled = ($lang?['disabled'=>'true']:[]); 
		$template = Theme::template($page->setting('template'))->forPage($page);
	?>
	<div class="row">
		<div class="col-sm-4 pull-right">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">{{ Languages::trans('admin.pages.page_settings') }}:</h4>
				</div>
				<div class="panel-body">
					<label for="">{{ Languages::trans('admin.pages.rendering_template') }}:</label>
					{!! Form::select('settings[template]', Theme::templates(), $page->setting('template'), array_merge(['class'=>'form-control'], $disabled)) !!}
						
					@if(!$page->id && $type != 'create')
						@include('admin.page.options')
					@else
						<div class="options-dynamic"></div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">{!! $title !!}</h4>
				</div>
				<div class="panel-body">
					<label>{{ Languages::trans('admin.pages.page_title') }}:</label>
					{!! Form::text('title', $page->title, ['class'=>'form-control mb15', 'required'=>true]) !!}
					<label>{{ Languages::trans('admin.pages.page_slug') }}:</label>
					<div class="input-group mb15">
						<span class="input-group-addon">{!! url('/').'/'.($lang?$lang.'/':'') !!}</span>
						
						{!! Form::text('slug', $page->slug, array_merge(['class'=>'form-control', 'required'=>true], $disabled)) !!}
					</div>
					@if(!$page->id && $type != 'create')
						<hr>
						<div class="mb15">{{ Languages::trans('admin.pages.page_content') }}:</div>
						@include('admin.page.content')
						<div id="page-content"></div>	
						<hr>
					@else
						<div class="page-dynamic">
							<hr>
							<div class="mb15">{{ Languages::trans('admin.pages.page_content') }}:</div>
							<div class="pd-render"></div>
							<div id="page-content"></div>	
							<hr>
						</div>
					@endif
					<label>{{ Languages::trans('admin.pages.meta_title') }}: (For SEO)</label>
					{!! Form::text('meta_title', $page->meta_title, ['class'=>'form-control mb15']) !!}
					<label>{{ Languages::trans('admin.pages.meta_keywords') }}: (For SEO)</label>
					{!! Form::text('meta_keywords', $page->meta_keywords, ['class'=>'form-control mb15']) !!}
					<label>{{ Languages::trans('admin.pages.meta_description') }}: (For SEO)</label>
					{!! Form::textarea('meta_description', $page->meta_description, ['class'=>'form-control', 'rows' => 5, 'style'=>'max-width: 100%;']) !!}
				</div>
				<div class="panel-footer">
					{!! Form::submit($submit, ['class'=>'btn btn-primary']) !!}
				</div>
			</div>

		</div>

		@if($type == 'edit')
			<div class="col-sm-4 pull-right">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">{{ Languages::trans('admin.pages.translations') }}:</h4>
					</div>
					<div class="panel-body">
						@foreach(Languages::all() as $lang)
		            		@if($page->translatedTo($lang))
		            			<a class="text-success" href="/admin/pages/{{ $page->id }}/translate/{{ $lang }}">{{ Languages::name($lang) }}</a><br>
		            		@endif
		            	@endforeach
		            	@foreach(Languages::all() as $lang)
		            		@if(!$page->translatedTo($lang))
		            			<a class="text-danger" href="/admin/pages/{{ $page->id }}/translate/{{ $lang }}">{{ Languages::name($lang) }}</a><br>
		            		@endif
		            	@endforeach
					</div>
				</div>
			</div>
		@endif
	</div>