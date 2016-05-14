@extends('templates.default')

@section('content')
	<div align="center">
        <h1><b>Ooops, looks like this page does not exist.</b></h1>
        <i id="sad" class="fa fa-frown-o fa-5x"></i>
        <hr>
        <h1>Click below button to navigate home.</h1>
        <a href="{{route('home')}}" align="center">
            <button class="btn btn-primary">
                Home
            </button>
        </a>
	</div>
@stop