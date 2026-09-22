<?php

namespace App\Utils;

class FakeRay {
	/**
	 * Magic method to swallow every forgotten ray() and rd() call
	 * if I ever forget to remove all mentions of ray() and rd() in production.
	 *
	 * @param string $name
	 * @param array $args
	 * @return static
	 */
	public function __call($name, $args): static {
		return $this;
	}
}
