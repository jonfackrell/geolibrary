let mix = require('laravel-mix');

mix.js('./assets/js/app.js', './javascripts')
    .postCss("./assets/css/app.css", "./css", [
        require("tailwindcss"),
    ])
    .setPublicPath('.');