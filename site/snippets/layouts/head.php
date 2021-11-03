<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<?php if(option('debug')): ?><meta name="robots" content="noindex, nofollow"><?php endif ?>

<title><?= $page->title() . ' • ' . $site->title() ?></title>
<script type="module">
	document.documentElement.classList.remove('no-js');
	document.documentElement.classList.add('js');
</script>

<?php /* META? */ ?>

<link rel="icon" href="/favicon.png">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">

<script src="/assets/vendor/alpine-3.5.0.min.js" defer></script>

<?= css(bundle('main.css')) ?>
