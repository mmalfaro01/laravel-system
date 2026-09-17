@php
	$viteManifestPath = public_path('build/manifest.json');
	$hasViteBuild = file_exists($viteManifestPath);
	$viteManifest = $hasViteBuild ? json_decode(file_get_contents($viteManifestPath), true) : [];
@endphp

@if ($hasViteBuild && isset($viteManifest['resources/assets/vendor/js/helpers.js']))
	<script type="module" src="{{ asset('build/' . $viteManifest['resources/assets/vendor/js/helpers.js']['file']) }}" defer></script>
@endif

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
