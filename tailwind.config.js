const colors = require('tailwindcss/colors')
const defaultConfig = require('tailwindcss/defaultConfig')

module.exports = {
	darkMode: 'media',
	theme: {
		screens: {
			'xs': '400px',
			...defaultConfig.theme.screens
		},
		extend: {
			colors: {
				gray: colors.neutral,
			}
		}
	},
	variants: {},
	plugins: [],
	corePlugins: {
		container: false,
	},
	content: [
		'./content/**/*.txt',
		'./site/layouts/**/*.php',
		'./site/templates/**/*.php',
		'./site/snippets/**/*.php',
		'./assets/**/*.js'
	],
	options: {
		safelist: [/^styled-html/]
	},
}
