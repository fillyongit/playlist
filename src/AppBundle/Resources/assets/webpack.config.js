var webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin")

const extractSass = new ExtractTextPlugin({
	  filename: "main.css",
});

module.exports = {
		entry: './main.js',
		output: {
			filename: 'bundle.js'
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /node_modules/,
					loader: 'babel-loader',
					options: {
						presets: ['env']
					}
				},
				{
			        test: /\.(scss)$/,
			        use: extractSass.extract({
			          fallback: 'style-loader',
			          //resolve-url-loader may be chained before sass-loader if necessary
			          use: [{
			            loader: "css-loader" // translates CSS into CommonJS
			          }, {
			              loader: 'postcss-loader', // Run post css actions
			              options: {
			                plugins: function () { // post css plugins, can be exported to postcss.config.js
			                  return [
			                    require('precss'),
			                    require('autoprefixer')
			                  ];
			                }
			              }
			            }, {
			            loader: "sass-loader" // compiles Sass to CSS
			          }]
			        })
			    }, {
			        test: /\.css$/,
			        use: ['style-loader', 'css-loader']
			    },
				{ 
					test: /\.(png|woff|woff2|eot|ttf|svg)$/, 
					loader: 'url-loader?limit=100000'
				}
			]
		},
		plugins: [
	        new webpack.ProvidePlugin({
	        	  $: 'jquery',
	        	  jQuery: 'jquery',
	        	  Popper: ['popper.js', 'default']
	        }),
	        extractSass
	    ]
}