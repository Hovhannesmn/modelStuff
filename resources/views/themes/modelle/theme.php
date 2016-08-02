<?php 

return [
	'name' => 'Modelle luneburg',
	'version'	=> '1.0.1',
	'slug'		=> 'modelle',

	'navigation' => [
		'primary' => [
			'name' => 'Primary navigation',
			'key' => 'primary',
		],
		'left' =>[
			'name' => 'Left sidebar navigation',
			'key'  => 'left'
		]
	],

	'options' => [
		[
			'title' 		=> 'Site logo',
			'name'			=> 'site_logo',
			'type'			=> 'image',
			'optional'		=> 'yes'
		],
		[
			'title' 		=> 'Use as [home] page',
			'name'			=> 'homepage',
			'type'			=> 'page',
			'optional'		=> 'no'
		],
		[
			'title' 		=> 'Home page background',
			'name'			=> 'homepage_background',
			'type'			=> 'image',
			'optional'		=> 'yes'
		]
	],

	'templates' => [
		'default' => [
			'name' => 'Default',
			'file' => 'page',
			'content' => [
				'general' => 'General',
			],
			'options' => []
		],
		'home' => [
			'name' => 'Home page',
			'file' => 'home',
			'content' => [
				'general' => 'General',
			],
			'options' => [
				'welcome_text' => [
					'type' => 'html',
					'name' => 'Welcome text'
				],
			]
		],
		'girls' => [
			'name' => 'Girls list',
			'file' => 'girls',
			'content' => [],
			'options' => [
				'jumbo_text' => [
					'type' => 'html',
					'name' => 'Jumbo text'
				],
				'jumbo_image' =>[
					'type' => 'image',
					'name' => 'Jumbo image'
				]
			]
		],
		'gallery' => [
			'name' => 'Gallery',
			'file' => 'gallery',
			'content' => [],
			'options' => [
				'gallery_to_show' => [
					'type' => 'gallery',
					'name' => 'Select gallery'
				]
			]
		],
		'weekplan' => [
			'name' => 'Weekplan',
			'file' => 'weekplan',
			'content' => [],
			'options' => []
		],
		'contacts' => [
			'name' => 'Contacts page',
			'file' => 'contact',
			'content' => [
				'getintouch' => 'Get in touch',
				'openinghours' => 'Opening hours',
				'map' => 'Map',
			],
			'options' => [
				'contact_form_title' => [
					'type' => 'html',
					'name' => 'Contact form title'
				],
				'getintouch_title' => [
					'type' => 'html',
					'name' => 'Get in touch title'
				],
				'contactinfo_title' => [
					'type' => 'html',
					'name' => 'Contact info title'
				],
				'openinghours_title' => [
					'type' => 'html',
					'name' => 'Opening hours title'
				],
			]
		]
	]
];