<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> {!! $title !!} </title>
	{!!HTML::style('css/bootstrap.css')!!}
	{!!HTML::script('js/bootstrap.js')!!}

</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		{!!HTML::link('/', 'Login Tutorial', ['class'=> 'navbar-brand'])!!}
		<ul class="nav navbar-nav pull-right">
			@if(Auth::user())
				<li>
					{!! HTML::link(action('UserController@ProcessLogout'), 'Logout') !!}
				</li>
			@else
				<li>
					{!! HTML::link(action('UserController@GetIndex'), 'Login') !!}
				</li>
				<li>
					{!! HTML::link(action('UserController@GetRegister'), 'Register') !!}
				</li>
			@endif
		</ul>
	</div>

	<div class="container">
		@yield('content')	
	</div>

</body>
</html>