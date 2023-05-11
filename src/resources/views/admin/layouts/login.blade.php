<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield("title", "Login") | LEVEL-UP</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset("admin-assets/vendors/css/vendor.bundle.base.css") }}">
	<link rel="stylesheet" href="{{ asset("admin-assets/vendors/css/vendor.bundle.addons.css") }}">
	<link rel="stylesheet" href="{{ asset("admin-assets/css/shared/style.css") }}">

	@livewireStyles
	@stack("style")
</head>
<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
				@if (isset($slot))
                {{ $slot }}
                @else
                @yield("content")
                @endif
			</div>
		</div>
	</div>
	<script src="{{ asset("admin-assets/vendors/js/vendor.bundle.base.js") }}"></script>
	<script src="{{ asset("admin-assets/vendors/js/vendor.bundle.addons.js") }}"></script>
	<script src="{{ asset("admin-assets/js/shared/off-canvas.js") }}"></script>
	<script src="{{ asset("admin-assets/js/shared/misc.js") }}"></script>

	@livewireScripts
	@stack("javascript")
</body>
</html>
