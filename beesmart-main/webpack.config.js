const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')

let conf = {
    entry: './assets/src/index.js',
    output: {
        path: path.resolve(__dirname, './assets/dist'),
        filename: 'main.bundle.js',
        publicPath: './assets/dist/'
    },
    // avorlay
    devServer: {
        ovarlay: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                // loader:'babel-loader',
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    }
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }
        ]
    },
    plugins: [
        // убедитесь что подключили плагин!
        new VueLoaderPlugin()
    ],
    resolve: {
        extensions: ['.js', '.vue']
    },
    watch: true,
    devtool: 'source-map',
}

module.exports = conf;
// (env, options) => {
//     let production = options.mode === 'production';

//     conf.devtool = production
//                         ? 'source-map'
//                         : 'eval-sourcemap'

//     return conf
// }


    // devtool: 'source-map',
    // mode: 'development',
    // entry:{
    //     filename: 'main.js',
    //     path: path.resolve(__dirname, 'assets/src')
    // },
    // context: path.resolve(__dirname, 'assets'),