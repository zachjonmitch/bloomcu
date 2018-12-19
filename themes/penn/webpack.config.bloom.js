//--------------------------------------------------------------
// WEBPACK CONFIG
//
// @author BloomCU
//--------------------------------------------------------------

const path = require('path'); // Needed for webpack to output path.
const webpack = require('webpack'); // Needed for ProvidePlugin to import jQuery.
const ExtractTextPlugin = require('extract-text-webpack-plugin'); // Separates files from JS. Example creates a .css file.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin'); // Browser Sync.
const UglifyJSPlugin = require('uglifyjs-webpack-plugin'); // Minify JS.
const CopyWebpackPlugin = require('copy-webpack-plugin'); // Copies individual files or entire directories to the build directory.
const devUrl = 'base.test'; // Your Localhost Domain Name without the protocol.

module.exports = env => {
	// @see https://webpack.js.org/guides/environment-variables/
	const isProduction = true === env.production; // Create boolean true if in production mode.
	const isInsecureDev = true === env.insecureDev; // Non-https dev mode.
	const mac = true === env.mac; // HTTPS .crt.

	let sourceMap = isProduction ? '' : 'inline-source-map'; // Set inline source map if not in production.

	// Setup Sass loaders for dev build.
	const sassLoaders = [
		{
			loader: 'css-loader', // @see https://webpack.js.org/loaders/css-loader/
			options: {
				sourceMap: !isProduction, // @see https://github.com/webpack-contrib/sass-loader#source-maps
				importLoaders: 1, // 0 => no loaders (default); 1 => postcss-loader; 2 => postcss-loader, sass-loader
				url: false, // @todo, we need to figure out proper url() pathing for fonts.
			},
		},
		{
			loader: 'sass-loader',
			options: {
				sourceMap: !isProduction, // @see https://github.com/webpack-contrib/sass-loader#source-maps
				outputStyle: 'compact', // @see https://github.com/sass/node-sass#outputstyle. Note: Currently required due to node-sass & bug https://github.com/webpack-contrib/sass-loader/issues/351
			},
		},
	];

	// Is Production.
	if (isProduction) {
		// Add PostCSS.
		sassLoaders.splice(1, 0, {
			loader: 'postcss-loader', // @see https://webpack.js.org/loaders/postcss-loader/. Note order is important https://webpack.js.org/loaders/postcss-loader/#config-cascade.
			// options: {
			// 	sourceMap: ! isProduction // @see https://webpack.js.org/loaders/postcss-loader/#usage
			// }
		});
	}

	const CONFIG = {
		entry: {
			base: mac // Load entry for Mac.
				? ['./assets/source/js/index.js', './assets/source/build/index.js']
				: './assets/source/js/index.js', 
			bloomio: './assets/source/js/bloomio/index-bloomio.js',
			bloomalytics: './assets/source/js/bloomio/bloomalytics.js',
		},
		output: {
			filename: 'js/[name].js', // [name] is generated from the object entry properties. Example output is base.js because entry.base above.
			path: path.resolve(__dirname, 'assets/dist'),
		},
		module: {
			// @see https://webpack.js.org/loaders/
			rules: [
				// Previously named 'loaders' in Webpack 1.
				{
					test: /\.(js|tsx)$/,
					// exclude: /node_modules/, // This wasn't compiling the ES6 from foundation when we excluded it.
					use: [
						{
							loader: 'babel-loader', // @see https://webpack.js.org/loaders/babel-loader/, https://github.com/babel/babel-loader
							options: {
								// @see https://babeljs.io/docs/usage/api/#options.
								presets: ['es2015'], // @see https://babeljs.io/docs/plugins/.
							},
						},
					],
				},
				{
					test: /\.scss$/,
					use: ExtractTextPlugin.extract({
						use: sassLoaders,
					}),
				},
				{
					test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/, // Fonts
					use: [
						{
							loader: 'file-loader', // @see https://webpack.js.org/loaders/file-loader/
							options: {
								name: 'fonts/[name].[ext]',
							},
						},
					],
					include: [
						// @see https://webpack.js.org/configuration/module/#condition. Only include .svg if in fonts folders.
						path.resolve(__dirname, 'assets/source/fonts/fonts'),
						path.resolve(__dirname, 'assets/source/fonts'),
					],
				},
				{
					test: /\.(png|jpg|gif|svg)$/, // Images
					use: [
						{
							loader: 'file-loader', // @see https://webpack.js.org/loaders/file-loader/
							options: {
								name: 'images/[name].[ext]',
							},
						},
					],
					exclude: [
						// @see https://webpack.js.org/configuration/module/#condition. Exclude .svg files if in fonts folders.
						path.resolve(__dirname, 'assets/source/fonts/fonts'),
						path.resolve(__dirname, 'assets/source/fonts'),
					],
				},
			],
		},
		devtool: sourceMap,
		externals: {
			// @see https://webpack.js.org/configuration/externals/
			jquery: 'jQuery', // Exclude jQuery from the final output file, rely on WordPress enqueue jQuery from Google CDN.
		},
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
				jQuery: 'jquery',
			}),
			new ExtractTextPlugin('css/[name].css'), // [name] comes from entry.property. In our case 'base'.css.
			new UglifyJSPlugin({
				// @see https://www.npmjs.com/package/uglifyjs-webpack-plugin
				test: /\.js$/i,
				sourceMap: !isProduction,
				compress: {
					drop_console: isProduction,
					warnings: false,
				},
				output: {
					beautify: !isProduction,
					comments: !isProduction,
				},
			}),
			new BrowserSyncPlugin({
				proxy: isInsecureDev ? `http://${devUrl}` : `https://${devUrl}`,
				host: 'localhost',
				port: 3000,
				https: {
					key: './assets/source/ssl/localhost.key',
					cert: `./assets/source/ssl/localhost.${mac ? 'crt' : 'cert'}`,
				},
				files: ['**/*.php'],
			}),
			new CopyWebpackPlugin([
				// @see https://www.npmjs.com/package/copy-webpack-plugin
				{
					from: 'assets/source/images',
					to: 'images',
				},
				{
					from: 'assets/source/css',
					to: 'css',
				},
				{
					// @todo We will no longer need this once pathing is updated for url().
					from: 'assets/source/fonts/fonts',
					to: 'fonts',
				},
			]),
		]
	};

	return CONFIG;
};
