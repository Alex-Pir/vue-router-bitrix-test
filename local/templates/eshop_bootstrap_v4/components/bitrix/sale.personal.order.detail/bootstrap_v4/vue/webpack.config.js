var path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin'); // ������ ��� �������� ���� Vue

module.exports = {
    entry: './templates/eshop_bootstrap_v4/components/bitrix/sale.personal.order.detail/bootstrap_v4/vue/src/main.js',
    output: {
        path: path.resolve(__dirname, './dist'),
        publicPath: '/dist/',
        filename: 'build.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }, {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin()
    ]
}