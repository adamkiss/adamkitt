<?php
try   { @require_once __DIR__ . '/vendor/autoload.php'; }
catch (Throwable $th) {
	// Missing dependecies. Install them first
	shell_exec('composer install -no && npm ci');
} finally { require_once __DIR__ . '/vendor/autoload.php'; }

use Kirby\Data\Data;
use Kirby\Toolkit\Str;
use Kirby\Filesystem\F;
use Kirby\Filesystem\Dir;

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
project-authorid:
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
$templateStrings['project-name'][1] = basename(__DIR__);
// Ask for template replacements
foreach($templateStrings as $key => [$question, $default]) {
	$answer = readline("{$question} [{$default}]: ");
	$replacements["tpl-{$key}"] = $answer ? $answer : $default;
	if ($key === 'project-name') {
		// set default project homepage to folder name (my usual)
		$templateStrings['project-homepage.com'][1] = $replacements['tpl-project-name'];
	}
}
// in these files:
$files = [
	'./composer.json', './package.json', './README.md',
	'./content/site.txt', './content/home/home.txt'
];

foreach($files as $file) {
	$original = F::read($file);
	$replaced = Str::replace($original, array_keys($replacements), array_values($replacements));
	F::write($file, $replaced);
}

F::remove('__install.php');
Dir::remove('.git');


echo <<< CLI
All installed! 🎉
Next steps:

cd public && valet link {$replacements['tpl-project-local-domain']} && cd ..
g this
g create -pd '{$replacements['tpl-project-description']}' -h '{$replacements['tpl-project-homepage.com']}'

You have to run those yourself.
👋
CLI;
