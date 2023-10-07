const outputPath = 'assets';

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: [
    path.join(__dirname, 'assets/source', 'js', 'app.js'),
    path.join(__dirname, 'assets/source', 'scss', 'app.scss'),
  ],
  output: {
    path: path.resolve(__dirname, outputPath),
    filename: 'js/bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: ['babel-loader'],
      },
      {
        test: /\.(c|sa|sc)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          // 'css-loader',
          {
            loader: 'css-loader',
            options: { url: false },
          },
          'postcss-loader',
          'sass-loader',
        ],
      },
    ],
  },
  resolve: {
    extensions: ['.wasm', '.ts', '.tsx', '.mjs', '.cjs', '.js', '.json'],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
  ],
};
