const colors = require('tailwindcss/colors')
const defaultConfig = require('tailwindcss/defaultConfig')

module.exports = {
	mode: 'jit',
	darkMode: 'media',
	theme: {
		screens: {
			'xs': '400px',
			...defaultConfig.theme.screens
		},
		extend: {
			colors: {
				gray: colors.trueGray,
			}
		}
	},
	variants: {},
	plugins: [],
	corePlugins: {
		container: false,
	},
	purge: {
		content: [
			'./site/templates/**/*.php',
			'./site/snippets/**/*.php',
			'./assets/**/*.js'
		],
		options: {
			safelist: [/^styled-html/]
		},
	}
}
