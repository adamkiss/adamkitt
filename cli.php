<?php

use Kirby\Cms\App;

include __DIR__ . '/vendor/autoload.php';

$kirby = new App([
	'roots' => [
		'index'    => __DIR__ . '/public',
		'base'     => $base = __DIR__,
		'content'  => $base . '/content',
		'site'     => $base . '/site',
		'storage'  => $storage = $base . '/storage',
		'accounts' => $storage . '/accounts',
		'cache'    => $storage . '/cache',
		'logs'     => $storage . '/logs',
		'sessions' => $storage . '/sessions',
		'db'       => $storage . '/db'
	]
]);

ray()->newScreen();
ray()->measure();

ray()->measure();
