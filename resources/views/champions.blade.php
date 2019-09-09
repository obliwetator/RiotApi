@extends('layout')

@section('title', 'Champions')

@section('content')

<div id = "champions container">
@foreach ($champions["keys"] as $item)
<div id = "individual champions" style="display:inline-block">
		<a href="#">
			<div id="image">
				<i class="__sprite __bg120 __bg120-{{$item}}"></i>
			</div>
			<div id="name">{{$item}}</div>
			<div id="role tags">
				<div id="add role tags"></div>
			</div>
		</a>
	</div>
@endforeach
	<div id = "individual champions" style="display:inline-block">
		<a href="#">
			<div id="image">
				<i class="__sprite __bg120 __bg120-Aatrox"></i>
			</div>
			<div id="name">Aatrox</div>
			<div id="role tags">
				<div id="add role tags"></div>
			</div>
		</a>
	</div>
	<div id = "individual champions" style="display:inline-block">
			<a href="#">
				<div id="image">
					<i class="__sprite __bg120 __bg120-Ahri"></i>
				</div>
				<div id="name">Ahri</div>
				<div id="role tags">
					<div id="add role tags"></div>
				</div>
			</a>
		</div>
		<div id = "individual champions" style="display:inline-block">
				<a href="#">
					<div id="image">
						<i class="__sprite __bg120 __bg120-Akali"></i>
					</div>
					<div id="name">Aatrox</div>
					<div id="role tags">
						<div id="add role tags"></div>
					</div>
				</a>
			</div>
</div>
@endsection