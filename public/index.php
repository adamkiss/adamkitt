<?php

use Kirby\Cms\App;

include '../vendor/autoload.php';

$base = dirname(__DIR__, 1);
$storage = $base . '/storage';

$kirby = new App([
	'roots' => [
		'index'    => __DIR__,
		'base'     => $base,
		'content'  => $base . '/content',
		'site'     => $base . '/site',
		'storage'  => $storage,
		'accounts' => $storage . '/accounts',
		'cache'    => $storage . '/cache',
		'logs'     => $storage . '/logs',
		'sessions' => $storage . '/sessions',
		'db'       => $storage . '/db'
	]
]);

echo $kirby->render();
