<!DOCTYPE html>
<html lang="sk" class="no-js">
@snippet('_assets')
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	@if (option('debug'))
		<meta name="robots" content="noindex, nofollow">
	@endif
	<title>{{ $page->title() }} • {{ $site->title() }}</title>

	<script type="module">
		document.documentElement.classList.remove('no-js');
		document.documentElement.classList.add('js');
	</script>

	@yield('meta')

	{{-- <meta name="description" content="Page description">
	<meta property="og:title" content="Unique page title - My Site">
	<meta property="og:description" content="Page description">
	<meta property="og:image" content="https://www.mywebsite.com/image.jpg">
	<meta property="og:image:alt" content="Image description">
	<meta property="og:locale" content="en_GB">
	<meta property="og:type" content="website">
	<meta name="twitter:card" content="summary_large_image">
	<meta property="og:url" content="https://www.mywebsite.com/page">
	<link rel="canonical" href="https://www.mywebsite.com/page"> --}}

	<link rel="icon" href="/favicon.png">
	<link rel="icon" href="/favicon.svg" type="image/svg+xml">
	{{-- <link rel="apple-touch-icon" href="/apple-touch-icon.png"> --}}

	<script src="/assets/vendor/alpine-3.2.2.js" defer></script>

	@css(bundle('main.css'))
</head>

<body class="antialiased">
	@yield('layout-content')

	@if (option('debug'))
		<div class="flex items-center m-2 fixed z-[200] bottom-0 left-0 rounded p-2 bg-gray-100 uppercase text-xl">
				<svg class="h-6 w-auto inline opacity-50" viewBox="0 0 80 64" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M32 16C24.8 16 20.3 19.6 18.5 26.8C21.2 23.2 24.35 21.85 27.95 22.75C30.004 23.2635 31.4721 24.7536 33.0971 26.4031C35.7443 29.0901 38.8081 32.2 45.5 32.2C52.7 32.2 57.2 28.6 59 21.4C56.3 25 53.15 26.35 49.55 25.45C47.496 24.9365 46.0279 23.4464 44.4029 21.7969C41.7557 19.1099 38.6919 16 32 16ZM18.5 32.2C11.3 32.2 6.8 35.8 5 43C7.7 39.4 10.85 38.05 14.45 38.95C16.504 39.4635 17.9721 40.9536 19.5971 42.6031C22.2443 45.2901 25.3081 48.4 32 48.4C39.2 48.4 43.7 44.8 45.5 37.6C42.8 41.2 39.65 42.55 36.05 41.65C33.996 41.1365 32.5279 39.6464 30.9029 37.9969C28.2557 35.3099 25.1919 32.2 18.5 32.2Z"></path>
				</svg>
				<span class="mr-2 xs:hidden">default (&lt; 400px)</span>
				<span class="mr-2 hidden xs:inline sm:hidden">xs</span>
				<span class="mr-2 hidden sm:inline md:hidden">sm</span>
				<span class="mr-2 hidden md:inline lg:hidden">md</span>
				<span class="mr-2 hidden lg:inline xl:hidden">lg</span>
				<span class="mr-2 hidden xl:inline 2xl:hidden">xl</span>
				<span class="mr-2 hidden 2xl:inline">2xl</span>
		</div>
	@endif
</body>
</html>
