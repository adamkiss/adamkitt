# tpl-project-name

> tpl-project-description

---

## Template information

This is a template for all my Kirby sites and experiments. Compared to default Kirby installs, starterkit, it uses following:

- Kirby & plugins are fully composer managed, with Kirby staying in the `vendor` folder
- Assets are fully managed through Vite, with Tailwind installed and latest Alpine vendored
- Accounts, Cache, Logs and Sessions were moved to storage
- instead of site plugin, all site-specific "plugin like" features are managed via `site/app`
- helpers are autoloaded via composer from `site/app/helpers.php`
- All snippets are included via custom `s()` method, which always returns, expects arguments via named variables, and supports all snippet methods:
	- `s('snippet', var: 'something')` - standard, non-slot snippet
	- `s('o:snippet', var: 'something')` - slot snippet being open
	- `s('c:snippet')` - `endsnippet` with a decorative label
	- `s('s:snippet', /* … */)` - alternative opening for slotted snippets
	- `s('e:snippet')` - alternative closing
	- `s('>snippet')` and `s('<snippet')` - another open/close snippet alternatives
		- these are based on a level of how deep you are (in, out), instead of html-like open `<` and close `>`
- Also included is a small Tailwind screen label, which also turns on and off the baseline grid overlay. For this to work, there must be a `.baseline-grid` class defined
- Upon installation, you may delete this section

## Installation

``` bash
./task install

# Develop front-end
./task
# Bundle assets for production
./task prod
```

## Notes

(c) 2026 tpl-project-author, unless stated otherwise.
