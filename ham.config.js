module.exports = {
	directory: 'public/assets/dist',
	manifest: 'site/snippets/_assets.php',
	template: files => (`<?php
		if (! function_exists('bundle')) {
			function bundle($key = '') {
				$manifest = [
					${Object.keys(files)
						.map(k => `'${k}' => '${files[k]}'`)
						.join(`,`)
					}
				];
				return array_key_exists($key, $manifest) ? "/assets/dist/{$manifest[$key]}" : "/assets/dev/{$key}";
			}
		}
	`)
}
