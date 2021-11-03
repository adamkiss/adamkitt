<?php
try   { @require_once __DIR__ . '/vendor/autoload.php'; }
catch (Throwable $th) {
	// Missing dependecies. Install them first
	shell_exec('composer install -no && npm ci');
} finally { require_once __DIR__ . '/vendor/autoload.php'; }

use Kirby\Data\Data;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use Kirby\Filesystem\F;

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
project-author-id:
	- Project author (id)
	- adamkiss
local-project-domain:
	- Local project domain (without .test)
	- project
project-homepage.com:
	- Live project domain
	- adamkiss.com
YAML, 'yaml');

// Special defaults
$templateStrings['project_name'][1] = basename(__DIR__);
$templateStrings['live_project_domain'][1] = $templateStrings['project_name'][1];
// Ask for replacements
foreach($templateStrings as $key => [$question, $default]) {
	$templateStrings[$key] = readline("{$question} [{$default}]: ") ?? '';
}
// in these files:
$files = [
	'./composer.json', './package.json', './README.md',
	'./content/site.txt', './content/home/home.txt'
];

foreach($files as $file) {
	F::write($file, Str::replace(
		array_keys($templateStrings), array_values($templateStrings), F::read($file)
	));
}

F::remove('__install.php');
