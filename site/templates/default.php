<?php /**
 * Default template for pages
 *
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Pages $pages
 * @var \Kirby\Cms\Site $site
 */

echo s('o:layout'); ?>

<div class="min-h-svh w-full grid place-content-center">
	<div>
		<h1><?= $page->title() ?></h1>
		<?= $page->text()->kt() ?>
	</div>
</div>
