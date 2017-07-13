const elixir = require('laravel-elixir');
require('laravel-elixir-browserify-official');
elixir.config.notifications = false;
elixir.config.css.autoprefix.options.browsers = [
'Android 2.3', 'Android >= 4', 'Chrome >= 20',
'Firefox >= 24', 'Explorer >= 7', 'iOS >= 6',
'Opera >= 12', 'Safari >= 5'
];
elixir(function(mix) {
    mix.browserify('./src/js/app.js', './assets/js/bundle.min.js');
    mix.browserSync({proxy: 'http://gerencie-gabinete.dev/'})

    mix.sass('./src/scss/app.scss', './assets/css/bundle.min.css');
});
