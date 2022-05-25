<?php

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
