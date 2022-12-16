const mix = require('laravel-mix');

mix
    .js('resources/js/admin/app.js', 'public/js/admin').vue()
    .postCss('resources/css/admin/app.css', 'public/css/admin', [
        require('postcss-import'),
        require('tailwindcss')('./tailwind.admin.config.js'),
        require('autoprefixer'),
    ])
    .js('resources/js/home/app.js', 'public/js/home').vue()
    .postCss('resources/css/home/app.css', 'public/css/home', [
        require('postcss-import'),
        require('tailwindcss')('./tailwind.home.config.js'),
        require('autoprefixer'),
    ]);
