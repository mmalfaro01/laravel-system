<!-- BEGIN: Vendor JS-->

@php
		$viteManifestPath = public_path('build/manifest.json');
		$hasViteBuild = file_exists($viteManifestPath);
		$viteManifest = $hasViteBuild ? json_decode(file_get_contents($viteManifestPath), true) : [];
@endphp

@if ($hasViteBuild && isset($viteManifest['resources/assets/js/main.js']))
	<script type="module" src="{{ asset('build/' . $viteManifest['resources/assets/js/main.js']['file']) }}" defer></script>
@endif

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
@yield('page-script')

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
