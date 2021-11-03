<?php
	layout();
	slot('content');
?>

<div class="container">
	<h1><?= $page->title() ?></h1>
	<?= $page->content()->kt() ?>
</div>

<?php endslot() ?>
