<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Collaborator</title>
		<link rel="shortcut icon" href="{{ asset('img/group_logo.png') }}">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
  		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ asset('assets/vendor/moment/min/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
	</head>
	<body>
		@include('templates.partials.navigation')
        <div class="container">
            @include('templates.partials.alerts')
            <div class="wrapper">
                @yield('content')
            </div>
        </div>
		<script src="{{ asset('js/common.js') }}"></script>
	</body>
	<footer>
		Copyright, KPH Systems © Collaborator, 2016
		<p>Version {{Config::get('app.version')}}</p>
	</footer>

</html>