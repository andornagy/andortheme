module.exports = {
    parser: 'postcss-scss',
    plugins: [
        require('postcss-preset-env')({
            browsers: 'last 2 versions',
        }),
    ],
};
