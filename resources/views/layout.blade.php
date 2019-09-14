<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', 'Home')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/champion120px.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/itemSprite64.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/customcss.css')}}">
	<script src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
	</script>
	<script src="{{ asset('js/js.js')}}"></script>
</head>

<body>
	<div class="p-0">
		<ul class="p-0">
			<li class="d-inline-block"><a href="/test">Test(Remove)</a></li>
			<li class="d-inline-block"><a href="/">Home</a></li>
			<li class="d-inline-block"><a href="/champions">Champions</a></li>
			<li class="d-inline-block"><a href="/stats">Stats</a></li>
			<li class="d-inline-block"><a href="/leaderboards">Leaderboards</a></li>
			<div class="d-inline-block">
				<div class="Region class"></div>
				<form action="/summoner" method="GET">
					<input type="text" class="Summoner name" name="name" placeholder="Summoner name">
					<button>Submit</button>
				</form>
			</div>
		</ul>
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