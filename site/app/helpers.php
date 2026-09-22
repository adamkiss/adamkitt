<?php

use App\Utils\FakeRay;
use App\Utils\Vite;
use Kirby\Template\Snippet;

if (! function_exists('s')) {
	/**
	 * Short snippet call for Kirby.
	 *
	 * Supports labels for controlling snippet behavior:
	 * - `s:`, `o:` or `>` for opening snippets
	 * - `c:`, `e:`, `<` for closing snippets
	 * Unlabeled snippets are treated as non-slot snippets calls,
	 * and return instead of echoing.
	 *
	 * @param string $snippet
	 * @param mixed ...$data
	 */
	function s(string $snippet, ...$data): string {
		$label = null;
		if (str_starts_with($snippet, '<') || str_starts_with($snippet, '>')) {
			$label = $snippet[0];
			$snippet = substr($snippet, 1);
		} else if ($snippet[1] === ':') {
			[$label, $snippet] = explode(':', $snippet, 2);
			$label = strtolower($label);
		}

		$slots = match($label) {
			'c', 'e', '<' => endsnippet(),
			'o', 's', '>' => true,
			null => false,
			default => throw new InvalidArgumentException("Invalid snippet label: $label"),
		};
		if (is_null($slots)) {
			return '';
		}

		$r = snippet($snippet, data: $data, return: true, slots: $slots);
		return ($r instanceof Snippet) ? '' : $r;
	}
}

if (! function_exists('vite')) {
	function vite(array|string|null $entries = null) {
		if (is_null($entries)) {
			return new Vite();
		}

		return (new Vite())->entries((array)$entries);
	}
}

if (! function_exists('ray')) {
	function ray(mixed ...$arg) {
		return new FakeRay($arg);
	}
}
if (! function_exists('rd')) {
	function rd(mixed ...$arg) {
		new FakeRay($arg);
		die();
	}
}
if (! function_exists('rtime')) {
	function rtime(float $start, $label = 'Execution time'): void {
		ray(sprintf('%s: %.3fms', $label, (hrtime(true) - $start) / 1_000_000));
	}
}
