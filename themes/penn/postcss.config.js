//--------------------------------------------------------------
// POSTCSS CONFIG
//
// Author: Rich Edmunds
// @see https://webpack.js.org/loaders/postcss-loader/#usage
// @see https://github.com/michael-ciniawsky/postcss-load-config
//--------------------------------------------------------------

module.exports = {
	plugins: {
		autoprefixer: {},
		cssnano: {
			zindex: false,
			reduceIdents: false,
		},
		'css-mqpacker': {
			sort: true,
		},
		'rucksack-css': { // @see https://www.rucksackcss.org/docs/
			responsiveType: false,
			shorthandPosition: false,
			quantityQueries: true,
			alias: false,
			inputPseudo: true,
			clearFix: false,
			fontPath: false,
			hexRGBA: false,
			easings: true
		},
	},
};
