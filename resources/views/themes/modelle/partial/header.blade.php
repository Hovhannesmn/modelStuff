<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ Theme::pageTitle($page) }}</title>

		<link href="{!! url('assets/t/modelle/css/frontend.css') !!}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]>
			<style type="text/css"> .gradient { filter: none; } </style>
		<![endif]-->
		<style> @font-face { font-family: "Miama"; src: url('{!! url('assets/t/modelle/fonts/Miama.otf') !!}') format('truetype'); } </style>
	</head>
	<body>