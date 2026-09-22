<?php

namespace App;

use App\Kirby\Tags;
use Kirby\Cms\App as Kirby;

class App {
	public function __construct(
		public Kirby $kirby
	) {
		$this->kirby->extend([
			'tags' => Tags::all()
		]);
	}
}
