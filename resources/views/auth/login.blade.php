<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRA PORTAL | RD&E</title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{asset('custom/css/font.css')}}">
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <style type="text/css">
  	
	@font-face {
	  font-family: 'Open Sans';
	  font-style: normal;
	  font-weight: 600;
	  src: url('/fonts/open-sans-v17-latin-regular.eot'); /* IE9 Compat Modes */
	  src: local('Open Sans Regular'), local('OpenSans-Regular'),
	       url('/fonts/open-sans-v17-latin-regular.eot?#iefix') format('embedded-opentype'),
	       url('/fonts/open-sans-v17-latin-regular.woff2') format('woff2'),
	       url('/fonts/open-sans-v17-latin-regular.woff') format('woff'),
	       url('/fonts/open-sans-v17-latin-regular.ttf') format('truetype'),
	       url('/fonts/open-sans-v17-latin-regular.svg#OpenSans') format('svg');
	}


	body{
	    font-family: 'Open Sans', sans-serif;
	}

  </style>

</head>
<body class="hold-transition login-page" style="background-color: #ecf0f5; zoom:107%;">
<div class="login-box">

	<div class="login-logo">
	  <span style="font-size: 28px;">SRA </b>Portal - RD&E</span>
	</div>

	@if(Session::has('AUTH_UNACTIVATED'))
		{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_UNACTIVATED')) !!}
	@endif

	@if(Session::has('CHECK_UNAUTHENTICATED'))
		{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_UNAUTHENTICATED')) !!}
	@endif

	@if(Session::has('CHECK_NOT_LOGGED_IN'))
		{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_LOGGED_IN')) !!}
	@endif

	@if(Session::has('CHECK_NOT_ACTIVE'))
		{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_ACTIVE')) !!}
	@endif

	@if(Session::has('PROFILE_UPDATE_USERNAME_SUCCESS'))
		{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_USERNAME_SUCCESS')) !!}
	@endif

	@if(Session::has('PROFILE_UPDATE_PASSWORD_SUCCESS'))
		{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_PASSWORD_SUCCESS')) !!}
	@endif

	@if(Session::has('LOGOUT_SUCCESS'))
		{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('LOGOUT_SUCCESS')) !!}
	@endif
	
	<div id="app">
		<login-form></login-form>
	</div>

</div>

<script type="text/javascript" src="{{ asset('js/LoginMain.js') }}"></script>

</body>
</html>
