<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="{{ asset('assets/plugins/sitebuilder/images/favicon.png') }}">

	<link href="{{ asset('assets/plugins/sitebuilder/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/sitebuilder/css/flat-ui-pro.css') }}" rel="stylesheet">  
	<link href="{{ asset('assets/plugins/sitebuilder/css/style.css') }}" rel="stylesheet">    
	<link href="{{ asset('assets/plugins/sitebuilder/css/font-awesome.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/plugins/sitebuilder/css/builder.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/sitebuilder/css/spectrum.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/sitebuilder/css/chosen.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/sitebuilder/css/summernote.css') }}" rel="stylesheet">

	<!--<link rel="stylesheet" href="{{ URL::to('src/css/build-main.min.css') }}">-->
	<script>
		var baseUrl = "{{ url('/') }}/";
		var siteUrl = "{{ url('/account/website/sitebuilder/') }}/";
	</script>
</head>

<body class="builderUI">

	@yield('content')

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
	</script>
</body>
</html>