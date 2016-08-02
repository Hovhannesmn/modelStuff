<?php 

return [
	'name' => 'Nicci (Single girl)',
	'version'	=> '1.0.1',
	'slug'		=> 'nicci',

	'navigation' => [
		'primary' => [
			'name' => 'Primary navigation'
		]
	],

	'options' => [
		[
			'title' 		=> 'Use as [home] page',
			'name'			=> 'homepage',
			'type'			=> 'page',
			'optional'		=> 'no'
		],
		[
			'title' 		=> 'Your profile',
			'name'			=> 'my_profile',
			'type'			=> 'profile',
			'optional'		=> 'no'
		],
		[
			'title' 		=> 'Page left side background',
			'name'			=> 'page_background_left',
			'type'			=> 'image',
			'optional'		=> 'yes'
		],
		[
			'title' 		=> 'Page left side background',
			'name'			=> 'page_background_right',
			'type'			=> 'image',
			'optional'		=> 'yes'
		]
	],

	'templates' => [
		'default' => [
			'name' => 'Default',
			'file' => 'page',
			'content' => [
				'general' => 'General'
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
				'mobile_image' => [
					'type' => 'image',
					'name' => 'Girl image (for mobiles)'
				],
				'homepage_slider' => [
					'type' => 'slider',
					'name' => 'Slider on top'
				]
			]
		],
		'profile' => [
			'name' => 'My profile',
			'file' => 'profile',
			'content' => [
				'general' => 'General'
			]
		],
		'services' => [
			'name' => 'My services',
			'file' => 'services',
			'content' => [
				'left_side' => 'Left side',
				'right_side' => 'Right side'
			],
			'options' => [
				'i_like_image' => [
					'type' => 'image',
					'name' => 'I like image'
				],
				'i_like_html' => [
					'type' => 'html',
					'name' => 'Like services title'
				],
				'i_notlike_html' => [
					'type' => 'html',
					'name' => 'Not like services title'
				]
			]
		],
		'contacts' => [
			'name' => 'Contacts page',
			'file' => 'contact',
			'content' => [
				'right_side' => 'Right side',
				'map' => 'Map',
			],
			'options' => [
				'contact_form_title' => [
					'type' => 'html',
					'name' => 'Contact form title'
				]
			]
		]
	]
];