<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

@php
		$viteManifestPath = public_path('build/manifest.json');
		$hasViteBuild = file_exists($viteManifestPath);
		$viteManifest = $hasViteBuild ? json_decode(file_get_contents($viteManifestPath), true) : [];
@endphp

@if ($hasViteBuild && isset($viteManifest['resources/assets/vendor/scss/core.scss']))
	<link rel="stylesheet" href="{{ asset('build/' . $viteManifest['resources/assets/vendor/scss/core.scss']['file']) }}">
@endif
@yield('vendor-style')

<!-- Page Styles -->
@yield('page-style')
