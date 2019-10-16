<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="description" content="Summoner look up tool for LoL">
	<meta name="keywords" content="League of Legends, Summoner">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', 'Home')</title>
	{{-- Boostrap CSS FULL --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	{{-- Sprite CSS for champion icons --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/champion120px.css') }}">
	{{-- Sprite CSS for items --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/itemSprite64.css')}}">
	{{-- Custom CSS  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/customcss.css')}}">
	{{-- Dark Mode --}}
	<link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
	{{-- Jquery --}}
	<script src="{{ asset('js/jquery-3.4.1.js')}}"></script>
	{{-- Bootstrap JS FULL --}}
	<script src="{{ asset('js/bootstrap.js') }}"></script>
	{{-- Custom js the will be used across all pages --}}
	<script src="{{ asset('js/js.js')}}"></script>

	@yield('js')
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
	<div class="p-0 bg-light">
		<ul class="p-0">
			<li class="d-inline-block"><a href="/test">Test(Remove)</a></li>
			<li class="d-inline-block"><a href="/">Home</a></li>
			<li class="d-inline-block"><a href="/champions">Champions</a></li>
			<li class="d-inline-block"><a href="/stats">Stats</a></li>
			<li class="d-inline-block"><a href="/leaderboards">Leaderboards</a></li>
			<li class="d-inline-block">
				<div >
					<div class="Region class"></div>
					<form action="/summoner" method="GET">
						<input type="text" class="Summoner name" name="name" placeholder="Summoner name">
						<button>Submit</button>
					</form>
				</div>
			</li>
			<li class="d-inline-block">
				<div class="custom-control custom-switch d-inline-block">
					<input type="checkbox" class="custom-control-input" id="darkSwitch">
					<label class="custom-control-label" for="darkSwitch">Dark Mode</label>
				</div> 
			</li>

		</ul>
		<script src="{{ asset('js/dark-mode-switch.min.js') }}"></script>
	</div>
	<div class="main">
		@yield('content')
	</div>
	<div class="footer">
		<hr>
		<p>Footer stuff(Edit in layout file)</p>
	</div>
</body>

</html>