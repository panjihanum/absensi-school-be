module.exports = {
  apps : [
    {
      name: "laravel-app",
      script: "artisan",
      args: "serve --port=8081",
      interpreter: "php",
      interpreter_args: "artisan",
      env: {
        NODE_ENV: "development"
      }
    }
  ]
}

