<?php
	layout();
	slot('content');
?>

<div class="container">
	<h1><?= $page->title() ?></h1>

	<?= $page->text()->kt() ?>
</div>

<?php endslot() ?>
