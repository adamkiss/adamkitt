<?php

namespace App\Kirby;

class Tags {
	public static function all() {
		return [
			static::span()
		];
	}

	public static function span() {
		return [
			'attr' => ['text'],
			'html' => function($tag) {
				$text = trim($tag->text(), '"');
				$classes = str_replace('.', ' ', $tag->value());
				return "<span class='{$classes}'>{$text}</span>";
			}
		];
	}
}
