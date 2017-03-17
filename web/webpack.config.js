module.exports = {
    entry: "./src",
    output: {
        path: __dirname + '/dist',
        filename: "bundle.js"
    },
    watch: true,
    module: {
         loaders: [{
             test: /\.js$/,
             exclude: /node_modules/,
             loader: 'babel-loader'
         },
         { 
             test: /\.html$/, 
             loader: 'html-loader' 
         }]
    }
};