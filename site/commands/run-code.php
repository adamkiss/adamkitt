<?php

return [
	'description' => 'Run a custom code file',
	'args' => [
		'file' => [
			'description' => 'File to require & run (default: $ROOT/cli.php)',
			'defaultValue' => 'cli.php'
		],
	],
	'command' => static function ($cli): void {
		ray()->newScreen();
		ray()->measure();

		try {

			$result = require_once dirname(__DIR__, 2) . '/' . $cli->arg('file');

		} catch (\Throwable $th) {
			ray()->exception($th);
			$result = '⚰️';
		}

		ray()->measure();
		$cli->success($result);
	}
];
