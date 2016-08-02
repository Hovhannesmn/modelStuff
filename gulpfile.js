var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
     //    .sass(
    	// 	'admin/admin-sass.scss',
    	// 	'resources/assets/css/admin/admin-sass.css'
    	// )
    	// .sass(
    	// 	'templates/nicci/frontend.scss',
    	// 	'public/assets/t/nicci/css/frontend.css'
    	// )
		.styles(
			[
				'admin/bracket/bootstrap.min.css',
				'admin/bracket/bootstrap-override.css',
				'admin/bracket/bootstrap-fileupload.min.css',
				'admin/bootstrap-select.min.css',
				'admin/bracket/bootstrap-timepicker.min.css',
				'admin/bracket/jquery-ui-1.10.3.css',
				'admin/bracket/animate.min.css',
				'admin/bracket/animate.delay.css',
				'admin/bracket/toggles.css',
				'admin/bracket/chosen.css',
				'admin/bracket/lato.css',
				'admin/bracket/jquery.gritter.css',
				'admin/bracket/style.default.css',
				'admin/bracket/dropzone.css',
				'admin/admin-sass.css',
				'admin/flag-icon.min.css',
				'admin/jquery.businessHours.css'
			],
			'public/assets/admin/css/admin.min.css'
		)
		.scripts(
			[
				'admin/bracket/jquery-1.10.2.min.js',
				'admin/bracket/jquery-migrate-1.2.1.min.js',
				'admin/bracket/bootstrap.min.js',
				'admin/bracket/bootstrap-fileupload.min.js',
				'admin/bootstrap-select.min.js',
				'admin/bracket/bootstrap-timepicker.min.js',
				'admin/bracket/modernizr.min.js',
				'admin/bracket/jquery.gritter.min.js',
				'admin/bracket/dropzone.min.js',
				'admin/bracket/jquery-ui-1.10.3.min.js',
				'admin/bracket/chosen.jquery.min.js',
				'admin/jquery.ddslick.min.js',
				'admin/toggles.min.js',
				'admin/timepicki.js',
				'admin/jquery.businessHours.js',
				'admin/frame.js',
				'admin/admin.js',
			],
			'public/assets/admin/js/admin.min.js'
		)
		.version(['assets/admin/css/admin.min.css', 'assets/admin/js/admin.min.js']);
});
