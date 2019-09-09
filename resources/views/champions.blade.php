@extends('layout')

@section('title', 'Champions')

@section('content')

<div id="champions container">
	@foreach ($champions["keys"] as $keys => $item)
	<div id="individual champions" style="position: relative; display: inline-block;">
		<a href="/champion/{{$item}}/statistics">
			<div id="image" style="position:relative;width:120px;height:120px;border:2px solid #000;">
				<i class="__sprite __bg120 __bg120-{{$item}}"></i>
			</div>
			<div id="name">{{$item}}</div>
			<div id="role tags" style="position: absolute; bottom: 25px; right: 0; text-align: right; line-height: 1">
				<div id="add role tags" style="display: block;">
					<span style = "    display: inline-block;
					line-height: 15px;
					font-size: 12px;
					letter-spacing: -0.9px;
					color: #fff;
					background: #353b3e;
					padding: 1px 6px 0 4px;">Top</span>
				</div>
				<div id="add role tags" style="display: block;">
					<span style = "    display: inline-block;
					line-height: 15px;
					font-size: 12px;
					letter-spacing: -0.9px;
					color: #fff;
					background: #353b3e;
					padding: 1px 6px 0 4px;">Middle</span>
				</div>
			</div>
		</a>
	</div>
	@endforeach
@endsection