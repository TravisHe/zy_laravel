<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ZanYiu</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- Bootstrap Core CSS -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

  <!--     Fonts and icons     -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="wrapper">

    @include('admin_inc/sidebar')

    <div class="main-panel">
	    @include('admin_inc/navbar')

			<div class="content">
				<div class="container-fluid">
	          @yield('content')
				</div>
			</div>

      @include('admin_inc/footer')
		</div>

	</div>
</body>

	<!--   Core JS Files   -->
	<script src="{{asset('js/dashboard.js')}}" type="text/javascript"></script>

</html>
