module.exports = {
    devServer: {
        port: 8081,
        watchOptions: {
            ignored: '/node_modules/',
            aggregateTimeout: 300,
            poll: 1000,
          },
    }
}