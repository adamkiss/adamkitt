<?php /**
 * Default template for pages
 *
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Pages $pages
 * @var \Kirby\Cms\Site $site
 */

?><!doctype html>
<html lang="sk" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<?php if(option('debug')): ?>
		<meta name="robots" content="noindex, nofollow">
	<?php endif ?>

	<title>
		<?= $page->title() . ' · ' . $site->title() ?>
	</title>
	<script type="module">
		document.documentElement.classList.replace('no-js', 'js');
	</script>

	<?php /* META? */ ?>

	<link rel="icon" href="/favicon.icon" sizes="16x16 32x32" type="image/x-icon">
	<link rel="icon" href="/favicon.svg" type="image/svg+xml">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">

	<script src="/assets/vendor/alpine-3.17.4.min.js" defer></script>

	<?= vite([
		'assets/main.js',
		'assets/main.css',
	]) ?>
</head>

<body class="antialiased dark:bg-gray-900 dark:text-white">
	<?= $slots->content ?? $slot ?? ''; ?>

	<?= s('debug'); ?>
</body>

</html>
