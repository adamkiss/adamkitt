<?php

use Kirby\Cms\App;
App::plugin('adamkiss/simple-snippets', []);

if (! function_exists('s')) {
	/**
	 * Short, auto-return snippet call with support for auto-merging certain parameters
	 *
	 * @param string $snippetName
	 * @param mixed ...$data
	 */
	function s($snippetName, ...$data): string {
		return snippet($snippetName, data: $data, return: true, slots: false);
	}
}

if (! function_exists('_s')) {
	/**
	 * Short, auto-return slot-opening snippet call with support for auto-merging certain parameters
	 *
	 * @param string $snippetName
	 * @param mixed ...$data
	 */
	function _s($snippetName, ...$data): Kirby\Template\Snippet {
		return snippet($snippetName, data: $data, return: true, slots: true);
	}
}

if (! function_exists('es')) {
	/**
	 * Shortcut for "ENDSNIPPET"
	 */
	function es() {
		return endsnippet();
	}
}


if (! function_exists('snippetAttributes')) {
	/**
	 * Take 'get_defined_vars' and return whitelisted array
	 *
	 * @param [type] $variables
	 * @param [type] ...$filter
	 * @return void
	 */
	function snippetAttributes($variables, ...$filter) {
		return array_filter($variables, fn($k) => in_array($k, $filter), ARRAY_FILTER_USE_KEY);
	}
}
