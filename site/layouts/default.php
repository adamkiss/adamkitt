<!DOCTYPE html>
<html lang="sk" class="no-js">
<?php snippet('_assets'); ?>

<head>
	<?php snippet('layouts/head'); ?>
</head>

<body class="antialiased dark:bg-gray-900 dark:text-white">
	<?php
		slot('content');
		endslot();

		snippet('layouts/debug');
	?>
</body>
</html>
