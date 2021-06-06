const rollupVue = require('rollup-plugin-vue');
const babelMinify = require('rollup-plugin-babel-minify');

module.exports = {
	input:  'src/script.js',
	output: '../script.js',
	plugins: {
		resolve: true,
		babel: false,
		custom: [
			rollupVue({}),
			babelMinify({
				comments: false,
			})
		]
	}
};