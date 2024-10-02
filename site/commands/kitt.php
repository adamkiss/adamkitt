<?php

use Kirby\Data\Data;
use Kirby\Toolkit\Str;
use Kirby\Filesystem\F;
use Kirby\Filesystem\Dir;

return [
	'description' => 'Install Adamkitt (instead of running php __install.php)',
	'args' => [],
	'command' => static function ($cli): void {
		$root = dirname(__FILE__, 3);

		try   { @require_once $root . '/vendor/autoload.php'; }
		catch (Throwable $th) {
			// Missing dependecies. Install them first
			shell_exec('composer install -no && pnpm i');
		} finally { require_once $root . '/vendor/autoload.php'; }

		$templateStrings = Data::decode(<<<YAML
		project-name:
			- Name of the project (a-z.)
			- woo
		project-description:
			- Description of the project
			- My awesome new project
		project-author:
			- Project author (full name)
			- Adam Kiss
		project-authid:
			- Project author (id)
			- adamkiss
		project-local-domain:
			- Local project domain (without .test)
			- project
		project-homepage.com:
			- Live project domain
			- adamkiss.com
		YAML, 'yaml');
		$replacements = [];

		// Set default project name to dirname
		$templateStrings['project-name'][1] = basename($root);
		// Ask for template replacements
		foreach($templateStrings as $key => [$question, $default]) {
			$input = $cli->input("{$question} [{$default}]: ")->defaultTo($default);
			$answer = $input->prompt();
			$replacements["tpl-{$key}"] = $answer ? $answer : $default;
			if ($key === 'project-name') {
				// set default project homepage to folder name (my usual)
				$templateStrings['project-homepage.com'][1] = $replacements['tpl-project-name'];
			}
		}

		// in these files:
		$files = [
			'/composer.json', '/package.json', '/README.md',
			'/content/site.txt', '/content/home/home.txt', '/task'
		];

		foreach($files as $file) {
			$original = F::read($root . $file);
			$replaced = Str::replace($original, array_keys($replacements), array_values($replacements));
			F::write($root . $file, $replaced);
		}

		Dir::remove($root . '/.git');

		$cli->output(<<< CLI
		All installed! 🎉
		Next steps:

		cd public && valet link {$replacements['tpl-project-local-domain']} && cd ..
		g this
		g create -pd '{$replacements['tpl-project-description']}' -h 'https://{$replacements['tpl-project-homepage.com']}'
		g fpush

		You have to run those yourself.
		CLI);

		$cli->success('👋 ');
	}
];
