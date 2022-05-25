<?php

if (! function_exists('s')) {
	/**
	 * Short, auto-return snippet call with support for auto-merging certain parameters
	 *
	 * @param string $snippetName
	 * @param mixed ...$data
	 */
	function s($snippetName, ...$data) {
		foreach ($data as $key => $value) {
			if (
				($key === 'content' || str_starts_with($key, 'slot-'))
				&& is_array($data[$key])
			) {
				$data[$key] = implode("", $data[$key]);
			}
		}
		return snippet($snippetName, $data, true);
	}
}

/**
 * Stubbing Ray
 *
 * instead of empty stub, include noop class so it doesn't die on me
 * if I forget to remove all mentions when going to prod
 */
class FakeRay {
	public function __call($name, $args): FakeRay
	{
		return $this;
	}
}
if (! function_exists('ray')) {
	function ray(...$arg) {
		return new FakeRay($arg);
	}
}
if (! function_exists('rd')) {
	function rd(...$arg) {
		new FakeRay($arg);
		die();
	}
}
