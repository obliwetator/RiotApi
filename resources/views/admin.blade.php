@extends('layout')
	
@section('title', 'Admin')

@section('js')

<script src="{{ asset('js/chart.js')}}"></script>
<script src="{{ asset('js/Admin.js')}}"></script>

@endsection

@section('content')

<div style="width:800px; height: 400px">
	<canvas id="myChart"></canvas>
</div>
@endsection