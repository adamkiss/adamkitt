<?php

use Kirby\Cms\App;

const KIRBY_HELPER_DUMP = false;
const KIRBY_HELPER_GO = false;

include __DIR__ . '/../vendor/autoload.php';

$kirby = new App([
	'roots' => [
		'index'    => __DIR__,
		'base'     => $base = dirname(__DIR__, 1),
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

echo $kirby->render();
