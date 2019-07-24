var PROXY_CONFIG = [
  {
    context: [
      "/php"
    ],
    target: "http://localhost",
    secure: false,
    logLevel: "debug",
    pathRewrite: {
      "^": "http://localhost"
    },
    changeOrigin: true
  }
]

module.exports = PROXY_CONFIG;