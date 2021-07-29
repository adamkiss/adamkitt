const plugins = [
	require('postcss-import'),
	require('postcss-nested'),
	require('tailwindcss'),
	require('autoprefixer'),
]

if ('NODE_ENV' in process.env && process.env.NODE_ENV === 'production') {
	plugins.push(require('cssnano'))
}

module.exports = {plugins}
